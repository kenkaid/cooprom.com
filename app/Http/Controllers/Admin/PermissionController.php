<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        if ($request->has('generate_default') && $request->generate_default == 1) {
            $request->validate([
                'module_name' => 'required|string',
            ]);

            $module = strtolower($request->module_name);
            $actions = ['list', 'create', 'edit', 'delete'];
            $createdCount = 0;

            foreach ($actions as $action) {
                $permissionName = $action . '-' . $module;

                // Vérifier si la permission existe déjà
                if (!Permission::where('name', $permissionName)->exists()) {
                    Permission::create([
                        'name' => $permissionName,
                        'guard_name' => 'web',
                        'description' => ucfirst($action) . ' ' . $module,
                        'state' => 1,
                    ]);
                    $createdCount++;
                }
            }

            return redirect()->route('admin.permissions.index')
                ->with('success', "$createdCount permissions par défaut générées pour le module '$module'.");
        }

        $request->validate([
            'name' => 'required|unique:permissions,name',
            'description' => 'nullable|string',
        ]);

        Permission::create([
            'name' => $request->name,
            'guard_name' => 'web',
            'description' => $request->description,
            'state' => 1,
        ]);

        return redirect()->route('admin.permissions.index')->with('success', 'Permission créée avec succès.');
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.update', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
            'description' => 'nullable|string',
        ]);

        $permission->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.permissions.index')->with('success', 'Permission mise à jour avec succès.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('admin.permissions.index')->with('success', 'Permission supprimée avec succès.');
    }
}
