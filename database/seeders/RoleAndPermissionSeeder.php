<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nettoyer le cache des permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Créer les rôles
        Role::firstOrCreate(['name' => 'super-admin'], [
            'uuid' => (string) \Illuminate\Support\Str::uuid(),
            'state' => 1,
            'level' => 1,
        ]);
        Role::firstOrCreate(['name' => 'admin'], [
            'uuid' => (string) \Illuminate\Support\Str::uuid(),
            'state' => 1,
            'level' => 2,
        ]);
        Role::firstOrCreate(['name' => 'staff'], [
            'uuid' => (string) \Illuminate\Support\Str::uuid(),
            'state' => 1,
            'level' => 3,
        ]);
        Role::firstOrCreate(['name' => 'adhérent'], [
            'uuid' => (string) \Illuminate\Support\Str::uuid(),
            'state' => 1,
            'level' => 4,
        ]);

        // Optionnel : Ajouter des permissions spécifiques plus tard
        // $permission = Permission::firstOrCreate(['name' => 'submit production']);
        // $adherentRole->givePermissionTo($permission);
    }
}
