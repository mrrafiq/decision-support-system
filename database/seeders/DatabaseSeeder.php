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

        $dm3 = new User;
        $dm3->username = 'Budi';
        $dm3->email = 'budi@example.com';
        $dm3->password = Hash::make('password');
        $dm3->save();
        $dm3->assignRole($decision_maker);


        DecisionSession::create(['name' => 'Perhitungan Budi']);
        // DecisionSession::create(['name' => 'Kedua']);

        DecisionMaker::create(['user_id' => 2, 'session_id' => 1, 'weight' => 0.5]);
        DecisionMaker::create(['user_id' => 3, 'session_id' => 1, 'weight' => 0.7]);
        DecisionMaker::create(['user_id' => 4, 'session_id' => 1, 'weight' => 0.7]);

        // DecisionMaker::create(['user_id' => 1, 'name' => 'John']);
        // DecisionMaker::create(['user_id' => 1, 'name' => 'Steve']);
        // DecisionMaker::create(['user_id' => 1, 'name' => 'Michael']);
        // DecisionMaker::create(['user_id' => 1, 'name' => 'Nisa']);

        Category::create(['name' => 'deskripsi', 'type' => '0']);
        Category::create(['name' => 'visi', 'type' => '1']);
        Category::create(['name' => 'misi']);
        Category::create(['name' => 'kurikulum', 'type' => '1']);
        Category::create(['name' => 'biaya_pembangunan', 'type' => '0']);
        Category::create(['name' => 'biaya_perbulan', 'type' => '0']);
        Category::create(['name' => 'program_unggulan', 'type' => '1']);
        Category::create(['name' => 'fasilitas', 'type' => '1']);
        Category::create(['name' => 'ekstrakurikuler', 'type' => '1']);

        $this->call([SchoolSeeder::class]);

        UserCategories::create(['session_id' => 1, 'category_id' => 1]);
        UserCategories::create(['session_id' => 1, 'category_id' => 2]);
        UserCategories::create(['session_id' => 1, 'category_id' => 5]);
        UserCategories::create(['session_id' => 1, 'category_id' => 6]);
        UserCategories::create(['session_id' => 1, 'category_id' => 8]);

        Scale::create(['point' => 0.11, 'status' => "Sangat Tidak Penting"]);
        Scale::create(['point' => 0.14, 'status' => "Jauh Lebih Tidak Penting"]);
        Scale::create(['point' => 0.20, 'status' => "Tidak Lebih Penting"]);
        Scale::create(['point' => 0.33, 'status' => "Tidak Cukup Penting"]);
        Scale::create(['point' => 1, 'status' => "Sama Penting"]);
        Scale::create(['point' => 3, 'status' => "Cukup Penting"]);
        Scale::create(['point' => 5, 'status' => "Lebih Penting"]);
        Scale::create(['point' => 7, 'status' => "Jauh Lebih Penting"]);
        Scale::create(['point' => 9, 'status' => "Sangat Lebih Penting"]);
    }
}
