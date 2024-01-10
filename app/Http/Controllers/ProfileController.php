<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function index(): View
    {
        $users = User::with(['roles', 'organization'])->paginate(20);
        return view('user.index', compact('users'));
    }
    public function create(Request $request): View
    {
        $organizations = Organization::orderBy('name')->get();
        return view('user.create', compact('organizations'));
    }
    public function store(StoreUserRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $user = User::createOrFirst(
                [
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'password' => $validated['password'],
                    'organization_id' => $validated['organization_id'],
                ]
            );
            $user->assignRole('Organization');
            $success = __('Successfully created the user.');
            DB::commit();
            return redirect()->route('users.index')->with(compact('success'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function show(User $user): View
    {
        $organizations = Organization::get();
        $user = User::whereId($user->id)->with('organization')->first();
        $roles = Role::all();
        return view('user.edit', compact('organizations', 'user', 'roles'));
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }
    public function userUpdate(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'organization_id' => $validated['organization'],
        ]);
        $user->syncRoles($validated['role']);
        return redirect()->back()->with('status', __('User updated!'))->withInput();
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

        return redirect()->back()->with('status', __('profile-updated'));
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
}
