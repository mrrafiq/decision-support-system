<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\School;
use App\Models\Category;
use App\Models\DecisionMaker;
use App\Models\UserCategories;
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

        School::create(['name' => 'MA AR-Risalah']);
        School::create(['name' => 'MA Tarbiyah Islamiyah']);
        School::create(['name' => 'MA PGAI Sumatera Barat']);

        DecisionMaker::create(['user_id' => 1, 'name' => 'John']);
        DecisionMaker::create(['user_id' => 1, 'name' => 'Steve']);
        DecisionMaker::create(['user_id' => 1, 'name' => 'Michael']);
        DecisionMaker::create(['user_id' => 1, 'name' => 'Nisa']);

        Category::create(['name' => 'deskripsi', 'type' => '0']);
        Category::create(['name' => 'gambar']);
        Category::create(['name' => 'visi', 'type' => '1']);
        Category::create(['name' => 'misi']);
        Category::create(['name' => 'kurikulum', 'type' => '1']);
        Category::create(['name' => 'biaya_pembangunan', 'type' => '0']);
        Category::create(['name' => 'biaya_perbulan', 'type' => '0']);
        Category::create(['name' => 'program_unggulan', 'type' => '1']);
        Category::create(['name' => 'fasilitas', 'type' => '1']);
        Category::create(['name' => 'ekstrakurikuler', 'type' => '1']);

        UserCategories::create(['user_id' => 1, 'category_id' => 1]);
        UserCategories::create(['user_id' => 1, 'category_id' => 3]);
        UserCategories::create(['user_id' => 1, 'category_id' => 5]);
        UserCategories::create(['user_id' => 1, 'category_id' => 6]);
        UserCategories::create(['user_id' => 1, 'category_id' => 7]);
        UserCategories::create(['user_id' => 1, 'category_id' => 8]);
    }
}
