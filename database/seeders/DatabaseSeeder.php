<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\School;
use App\Models\Category;
use App\Models\DecisionMaker;
use App\Models\DecisionSession;
use App\Models\UserCategories;
use App\Models\Scale;
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

        //Permission for Category
        Permission::create(['name' => 'create_category']);
        Permission::create(['name' => 'update_category']);
        Permission::create(['name' => 'read_category']);
        Permission::create(['name' => 'delete_category']);

        $administrator = Role::create(['name' => 'administrator']);
        $decision_maker = Role::create(['name' => 'decision_maker']);

        $administrator->givePermissionTo(Permission::all());

        $user = new User;
        $user->username = 'Administrator';
        $user->email = 'admin@example.com';
        $user->password = Hash::make('password');
        $user->save();
        $user->assignRole($administrator);

        $dm = new User;
        $dm->username = 'Andi';
        $dm->email = 'andi@example.com';
        $dm->password = Hash::make('password');
        $dm->save();
        $dm->assignRole($decision_maker);

        $dm2 = new User;
        $dm2->username = 'Yanti';
        $dm2->email = 'yanti@example.com';
        $dm2->password = Hash::make('password');
        $dm2->save();
        $dm2->assignRole($decision_maker);

        School::create(['name' => 'MA AR-Risalah']);
        School::create(['name' => 'MA Tarbiyah Islamiyah']);
        School::create(['name' => 'MA PGAI Sumatera Barat']);

        DecisionSession::create(['name' => 'Pertama']);
        DecisionSession::create(['name' => 'Kedua']);

        DecisionMaker::create(['user_id' => 2, 'session_id' => 1, 'weight' => 0.7]);
        DecisionMaker::create(['user_id' => 3, 'session_id' => 1, 'weight' => 0.5]);

        // DecisionMaker::create(['user_id' => 1, 'name' => 'John']);
        // DecisionMaker::create(['user_id' => 1, 'name' => 'Steve']);
        // DecisionMaker::create(['user_id' => 1, 'name' => 'Michael']);
        // DecisionMaker::create(['user_id' => 1, 'name' => 'Nisa']);

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

        UserCategories::create(['session_id' => 1, 'category_id' => 1]);
        UserCategories::create(['session_id' => 1, 'category_id' => 3]);
        UserCategories::create(['session_id' => 1, 'category_id' => 5]);
        UserCategories::create(['session_id' => 1, 'category_id' => 6]);

        Scale::create(['point' => 1, 'status' => "Sangat Tidak Penting"]);
        Scale::create(['point' => 2, 'status' => "Tidak Terlalu Penting"]);
        Scale::create(['point' => 3, 'status' => "Sama Penting"]);
        Scale::create(['point' => 4, 'status' => "Agak Penting"]);
        Scale::create(['point' => 5, 'status' => "Penting"]);
        Scale::create(['point' => 6, 'status' => "Sedikit Lebih Penting"]);
        Scale::create(['point' => 7, 'status' => "Sangat Penting"]);
        Scale::create(['point' => 8, 'status' => "Sangat Lebih Penting"]);
        Scale::create(['point' => 9, 'status' => "Paling Penting"]);
    }
}
