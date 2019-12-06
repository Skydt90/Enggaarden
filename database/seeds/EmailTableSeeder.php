<?php

use App\Models\Email;
use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $members = Member::all();
        $users = User::all();

        $count = (int) $this->command->ask('How many emails would you like? (Max: ' . $members->count() . ') ' ,
            ceil($members->count() / 2));

        factory(Email::class, $count)->make()->each(function($email, $index) use ($members, $users) {
            if($index % 2 !== 0) {
                $email->member_id = $members->random()->id;
            } else {
                $email->group = Email::MAIL_GROUPS[rand(0, 4)];
            }
            $email->user_id = $users->random()->id;
            $email->save();
        });
    }
}
