<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = \App\Models\User::updateOrCreate(
            ['email' => 'admin@cooprom.ci'],
            [
                'uuid' => (string) \Illuminate\Support\Str::uuid(),
                'name' => 'Super',
                'last_name' => 'Admin',
                'password' => \Illuminate\Support\Facades\Hash::make('regexREGEX'),
                'phone_number' => '00000000',
                'cultural_sector_id' => 1,
                'user_created_id' => 1,
                'user_updated_id' => 1,
            ]
        );

        $admin->assignRole('super-admin');
    }
}
