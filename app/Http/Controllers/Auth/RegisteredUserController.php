<?php

namespace App\Http\Controllers\Auth;

use App\Enums\RecordState;
use App\Http\Controllers\Controller;
use App\Models\AcademicStage;
use App\Models\MemberShip;
use App\Models\MemberShipType;
use App\Models\School;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Rules\ValidNidRule;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Laratrust\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $membershipTypes = MembershipType::all();
        $academicStages = AcademicStage::all();
        $data = [
            'membershipTypes' => $membershipTypes,
            'academicStages' => $academicStages,
        ];
        return view('auth.register', $data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
            'confirm_password' => ['required', 'same:password'],
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
        if (isset($request->member_already) && $request->member_already == RecordState::ACTIVE->value) {
            $request->validate([
                'membership_type' => ['required', 'exists:' . MemberShipType::class . ',id'],
                'membership_number' => ['nullable', 'string', 'max:255', 'unique:' . User::class],
            ]);

            $membership = MemberShip::create([
                'member_ship_type_id' => $request->membership_type,
                'record_state' => RecordState::INACTIVE->value,
            ]);
        }

        if (isset($request->student) && $request->student == RecordState::ACTIVE->value) {
            $request->validate([
                'academic_stage' => ['required', 'exists:' . AcademicStage::class . ',id'],
            ]);
        }

//        return response()->json($request->all());
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email ?? $request->nid . '@' . env('APP_DOMAIN', 'mgahed.com'),
                'password' => $request->password ? Hash::make($request->password) : Hash::make($request->nid . rand(1000, 9999)),
                'nid' => $request->nid,
                'birth_date' => $birthDate,
                'gender' => $gender,
                'email_verified_at' => null,
                'mobile' => $request->mobile,
                // $request->membership_number ?? get latest membership_number + 1 from users table
                'membership_number' => $request->membership_number ?? User::query()->max('membership_number') + 1,
                'record_state' => RecordState::INACTIVE->value,
                'academic_stage_id' => $request->academic_stage ?? null,
            ]);

            if ($user && isset($membership)) {
//            dd($request->all());
                $membership->user_id = $user->id;
                $membership->save();
            }

            $studentRole = Role::where('name', 'member')->first();
            $user->addRole($studentRole);

            event(new Registered($user));

            Auth::login($user);
            DB::commit();

            return redirect(RouteServiceProvider::HOME);
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
