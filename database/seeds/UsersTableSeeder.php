<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->truncate();

        $userCount = (int) $this->command->ask('How many users would you like?', 10);

        factory(User::class)->states('britta')->create(); // user for login and testing purposes
        factory(User::class, $userCount)->create();
    }
}
