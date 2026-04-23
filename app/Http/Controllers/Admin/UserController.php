<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use App\Models\CulturalSector;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();
        $roles = Role::all();
        return view('admin.user.index', compact('users', 'roles'));
    }

    public function create()
    {
        $sectors = CulturalSector::all();
        $roles = Role::all();
        return view('admin.user.create', compact('sectors', 'roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'phone_number' => 'required|string',
            'cultural_sector_id' => 'required|integer|exists:cultural_sectors,id',
            'address' => 'nullable|string',
            'roles' => 'required|array',
            'roles.*' => 'string|exists:roles,name',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'vimeo' => 'nullable|url',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('users', 'public');
            $validated['photo'] = $path;
        }

        $user = $this->userService->createUser($validated);
        $user->assignRole($request->roles);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    public function edit($uuid)
    {
        $user = $this->userService->getUser($uuid);
        $sectors = CulturalSector::all();
        $roles = Role::all();
        return view('admin.user.update', compact('user', 'sectors', 'roles'));
    }

    public function update(Request $request, $uuid)
    {
        $user = $this->userService->getUser($uuid);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone_number' => 'required|string',
            'cultural_sector_id' => 'required|integer|exists:cultural_sectors,id',
            'address' => 'nullable|string',
            'password' => 'nullable|min:8',
            'roles' => 'required|array',
            'roles.*' => 'string|exists:roles,name',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'vimeo' => 'nullable|url',
            'status' => 'required|integer|in:0,1',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('users', 'public');
            $validated['photo'] = $path;
        }

        $this->userService->updateUser($uuid, array_filter($validated, function($value) {
            return $value !== null;
        }));

        $user->syncRoles($request->roles);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function updateRoles(Request $request, $uuid)
    {
        $user = $this->userService->getUser($uuid);
        $request->validate([
            'roles' => 'required|array',
            'roles.*' => 'string|exists:roles,name',
        ]);

        $user->syncRoles($request->roles);

        return redirect()->back()->with('success', 'Rôles mis à jour avec succès.');
    }

    public function destroy($uuid)
    {
        $this->userService->deleteUser($uuid);
        return redirect()->route('admin.users.index')->with('success', 'Adhérent supprimé avec succès.');
    }
}
