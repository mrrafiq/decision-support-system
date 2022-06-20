<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\School;
use App\Models\Category;
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

        //Permission for School
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

        $school = new School;
        $school->name = 'MA Ar-risalah';
        $school->save();

        Category::create(['name' => 'deskripsi']);
        Category::create(['name' => 'gambar']);
        Category::create(['name' => 'visi']);
        Category::create(['name' => 'misi']);
        Category::create(['name' => 'kurikulum']);
        Category::create(['name' => 'biaya_pembangunan']);
        Category::create(['name' => 'biaya_perbulan']);
        Category::create(['name' => 'program_unggulan']);
        Category::create(['name' => 'fasilitas']);
        Category::create(['name' => 'ekstrakurikuler']);

    }
}
