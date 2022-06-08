<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        //Permission for Decision Maker
        Permission::create(['name' => 'create_decision_maker']);
        Permission::create(['name' => 'update_decision_maker']);
        Permission::create(['name' => 'read_decision_maker']);
        Permission::create(['name' => 'delete_decision_maker']);

        //Permission for Pondok Pesantren
        Permission::create(['name' => 'create_school']);
        Permission::create(['name' => 'update_school']);
        Permission::create(['name' => 'read_school']);
        Permission::create(['name' => 'delete_school']);

        $administrator = Role::create(['name' => 'administrator']);
        $user_only = Role::create(['name' => 'user_only']);

        $administrator->givePermissionTo(Permission::all());

        $user = new User;
        $user->username = 'Administrator';
        $user->email = 'admin@example.com';
        $user->password = Hash::make('password');
        $user->save();
        $user->assignRole($administrator);

        $user_only->givePermissionTo([
            'create_decision_maker',
            'update_decision_maker',
            'read_decision_maker',
            'delete_decision_maker'
        ]);

    }
}
