<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\AcademicStage;
use App\Models\MemberShipType;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = User::with(['roles', 'memberShip.membershipType', 'academicStage'])
            ->findOrFail($request->user()->id);

        $user->role = $user->roles->first()->display_name;

        $membershipTypes = MembershipType::all();
        $academicStages = AcademicStage::all();

        $result = [
            'selectedItem' => $user,
            'membershipTypes' => $membershipTypes,
            'academicStages' => $academicStages,
            'title' => __('admin.User profile'),
        ];
        return view('profile.edit', $result);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function dataByNid(Request $request)
    {
        // validate nid
        $request->validate([
            'nid' => 'required|numeric|digits:14|exists:users,nid',
        ]);
        $nid = $request->nid;
        $user = User::where('nid', $nid)->first();
        if ($user) {
            return response()->json([
                'status' => 'success',
                'data' => $user,
            ]);
        }
        return response()->json([
            'status' => 'error',
            'message' => __('admin.User not found'),
        ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => ['required', Password::defaults()],
            'password_confirmation' => ['required', 'same:password'],
        ]);

        $user = $request->user();
        if (!Auth::attempt(['mobile' => $user->mobile, 'password' => $request->current_password])) {
            return Redirect::back()->withErrors(['current_password' => __('admin.Wrong password')]);
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back()->with('success', __('admin.Password changed successfully'));
    }
}
