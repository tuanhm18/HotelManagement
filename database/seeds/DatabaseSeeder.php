<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
         DB::table('users')->insert([
            'username' => 'admin',
            'password' => bcrypt('123456'),
            'LastName' => 'Web',
            'FirstName' => 'Admin',
            'Role' => 'Admin',
            'CreatedDate' => now()
        ]); 
    }
}
