<?php

use App\Models\ExternalUser;
use App\Models\Member;
use Illuminate\Database\Seeder;

class ExternalUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // clear table data
        ExternalUser::query()->truncate();
        
        // fetch all members for id's
        $members = Member::all();

        $eUserCount = (int) $this->command->ask('How many external users would you like? (Max: ' . $members->count() . ') ' ,
            ceil($members->count() / 2));

        factory(ExternalUser::class, $eUserCount)->make()->each(function($externalUser, $index) use ($members) {
            
            $externalUser->member_id = $members[$index]->id;
            $externalUser->save();
        });
    }
}
