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
            'first_name'=>'John',
            'last_name'=>'Doe',
            'email'=>'admin@admin.com',
            'phone'=>'5135551234',
            'password'=>bcrypt('Password1'),
            'chapter_class'=>'Developer Class',
            'roll_number'=>1,
            'school_class'=>2010,
            'active_status'=>1
        ]);
    }
}
