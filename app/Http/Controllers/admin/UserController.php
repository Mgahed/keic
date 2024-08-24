<?php

namespace App\Http\Controllers\admin;

use App\Enums\RecordState;
use App\Http\Controllers\Controller;
use App\Models\AcademicStage;
use App\Models\MemberShip;
use App\Models\MemberShipType;
use App\Models\Role;
use App\Models\UserQuestionAnswers;
use App\Rules\ValidNidRule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles', 'memberShip', 'academicStage')->get();
        foreach ($users as $user) {
            $user->role = $user->roles->first()->display_name;
        }
        $result = [
            'data' => $users,
            'title' => __('admin.Users'),
            'addUrl' => [
                'url' => route('admin.users.create'),
                'text' => __('admin.Add'),
            ]

        ];
        return view('admin.users.index', $result);
    }

    public function create()
    {
        return view('admin.users.edit', [
            'title' => __('admin.Add') . ' ' . __('admin.User'),
            'membershipTypes' => MemberShipType::all(),
            'academicStages' => AcademicStage::all(),
            'method' => 'POST',
            'action' => route('admin.users.store'),
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['nullable', Password::defaults()],
            // nid unique, length 14, numeric
            'nid' => ['required', 'unique:' . User::class, 'digits:14', 'numeric', new ValidNidRule()],
            // mobile unique, length 11, numeric, must start with 01 and third digit must be 1, 2, 5, 0
            'mobile' => [
                'required',
                'unique:' . User::class,
                'digits:11',
                'numeric',
                'regex:/^01[1250][0-9]{8}$/',
            ],
        ]);

        // birth_date
        $birthDate = getBirthDate($request->nid);

        // gender
        $gender = getGender($request->nid);

        DB::beginTransaction();
        if (isset($request->membership)) {
            $request->validate([
                'membership' => ['required', 'exists:' . MemberShipType::class . ',id'],
                'membership_number' => ['nullable', 'string', 'max:255', 'unique:' . User::class],
                'membership_start_date' => ['required', 'date'],
            ]);

            $memberShipType = MemberShipType::findOrFail($request->membership);
            $endDate = Carbon::parse($request->membership_start_date)->addDays($memberShipType->weight_in_days);

            $membership = MemberShip::create([
                'member_ship_type_id' => $request->membership,
                'record_state' => $request->membership_status ?? RecordState::INACTIVE->value,
                'start_date' => $request->membership_start_date,
                'end_date' => $endDate,

            ]);
        }

        if (isset($request->academic_stage) && $request->academic_stage != null) {
            $request->validate([
                'academic_stage' => ['required', 'exists:' . AcademicStage::class . ',id'],
            ]);
        }

//        return response()->json($request->all());
        try {
            $configurations = $request->configs;
            $userConfigs = $this->userConfigs($configurations);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email ?? $request->nid . '@' . env('APP_DOMAIN', 'mgahed.com'),
                'password' => $request->password ? Hash::make($request->password) : Hash::make($request->nid . $request->mobile),
                'nid' => $request->nid,
                'birth_date' => $birthDate,
                'gender' => $gender,
                'email_verified_at' => null,
                'mobile' => $request->mobile,
                // $request->membership_number ?? get latest membership_number + 1 from users table
                'membership_number' => $request->membership_number ?? User::query()->max('membership_number') + 1,
                'configurations' => json_encode($userConfigs),
                'record_state' => isset($request->record_state) ? $request->record_state : RecordState::INACTIVE->value,
                'academic_stage_id' => $request->academic_stage ?? null,
            ]);

            if ($user && isset($membership)) {
                $membership->user_id = $user->id;
                $membership->save();
            }

            $studentRole = Role::where('name', 'member')->first();
            $user->addRole($studentRole);


            DB::commit();

            return redirect()->back()->with('success', __('admin.User created successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $user = User::with(['roles', 'memberShip', 'academicStage'])
        ->findOrFail($id);

        $user->role = $user->roles->first()->display_name;

        $membershipTypes = MembershipType::all();
        $academicStages = AcademicStage::all();

        $result = [
            'selectedItem' => $user,
            'membershipTypes' => $membershipTypes,
            'academicStages' => $academicStages,
            'title' => __('admin.User') . ' ' . $user->name,
            'method' => 'PUT',
            'action' => route('admin.users.update', $id),
        ];
        return view('admin.users.edit', $result);
    }

    public function edit($id)
    {
        return $this->show($id);
    }

    public function update(Request $request, $id)
    {
//        return $request->all();

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            // nid unique, length 14, numeric
            'nid' => ['required', 'unique:' . User::class . ',nid,' . $id, 'digits:14', 'numeric', new ValidNidRule()],
            // mobile unique, length 11, numeric, must start with 01 and third digit must be 1, 2, 5, 0
            'mobile' => [
                'required',
                'unique:' . User::class . ',mobile,' . $id,
                'digits:11',
                'numeric',
                'regex:/^01[1250][0-9]{8}$/',
            ],
            'membership' => ['required', 'exists:' . MemberShipType::class . ',id'],
            'membership_start_date' => ['required', 'date'],
            'membership_status' => ['required', 'in:1,0'],
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with('error', 'admin.Please check the errors')
                ->withErrors($validator)
                ->withInput();
        }
        try {

            // birth_date
            $birthDate = getBirthDate($request->nid);

            // gender
            $gender = getGender($request->nid);

            DB::beginTransaction();
            $user = User::findOrFail($id);
            $configurations = $request->configs;
            $userConfigs = $this->userConfigs($configurations);
            $user->update([
                'name' => $request->name,
                'academic_stage_id' => $request->academic_stage,
                'nid' => $request->nid,
                'mobile' => $request->mobile,
                'birth_date' => $birthDate,
                'gender' => $gender,
                'record_state' => $request->record_state ?? RecordState::INACTIVE->value,
                'configurations' => $userConfigs,
            ]);

            $memberShipType = MemberShipType::findOrFail($request->membership);
            $endDate = Carbon::parse($request->membership_start_date)->addDays($memberShipType->weight_in_days);

            $checkMembership = $user->memberShip->first();
            if (!$checkMembership) {
                $user->memberShip()->create([
                    'member_ship_type_id' => $request->membership,
                    'start_date' => $request->membership_start_date,
                    'end_date' => $endDate,
                    'record_state' => $request->membership_status,
                ]);
            } else {
                $user->memberShip->first()->update([
                    'member_ship_type_id' => $request->membership,
                    'start_date' => $request->membership_start_date,
                    'end_date' => $endDate,
                    'record_state' => $request->membership_status,
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', __('admin.User updated successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'admin.Something went wrong')
                ->withInput();
        }
    }

    public function destroy($id)
    {
//        $user = User::findOrFail($id);
//        $user->delete();
//        return redirect()->route('pages.admin.users.index');
    }

    public function checkUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric|exists:users,id',
        ]);
        $user = User::where('id', $request->user_id)
            ->with('memberShip')
            ->first();
        return redirect()->back()->with('checkedUser', $user);
    }

    /**
     * @param mixed $configurations
     * @return array
     */
    private function userConfigs(mixed $configurations)
    {
        if (empty($configurations) || !is_array($configurations)) {
            return null;
        }
        $userConfigs = [];
        foreach ($configurations as $key => $value) {
            $userConfigs[] = [
                $value['config_key'] => $value['config_value']
            ];
        }
        return $userConfigs;
    }
}
