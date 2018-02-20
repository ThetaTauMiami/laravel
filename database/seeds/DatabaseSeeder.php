<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'first_name'=>'Admin',
            'last_name'=>'Testerson',
            'email'=>'admin@admin.com',
            'phone'=>'5135551234',
            'password'=>bcrypt('Password1'),
            'chapter_class'=>'Developer Class',
            'roll_number'=>1,
            'school_class'=>2010,
            'active_status'=>1
        ]);

        DB::table('roles')->insert([
            'name' => 'Admin',
            'type' => 'admin',
            'rank_order' => 1,
            'active' => 1
        ]);

        DB::table('semesters')->insert([
            'name' => 'Spring 2018',
            'date_start' => 2018-01-01
        ]);

        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 1,
            'semester_id' => 1
        ]);
    }
}
