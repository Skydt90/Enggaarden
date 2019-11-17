<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if($this->command->confirm('Do you want to reseed the database?', true)) {
            $this->call([
                UsersTableSeeder::class,
                MembersTableSeeder::class
            ]);
        } 
    }
}
