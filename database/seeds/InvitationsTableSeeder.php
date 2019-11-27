<?php

use App\Models\Invite;
use App\Models\Member;
use Illuminate\Database\Seeder;

class InvitationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Invite::query()->truncate();

        $members = Member::all();

        $inviteCount = (int) $this->command->ask('How many invites would you like? (Max: ' . $members->count() . ') ' ,
            ceil($members->count() / 3));

        factory(Invite::class, $inviteCount)->make()->each(function ($invite, $index) {
            $invite->member_id = ($index * 2 + 1);
            $invite->save();
        });
    }
}
