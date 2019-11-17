<?php

use App\Models\Address;
use App\Models\Member;
use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Member::query()->delete();

        // create 20 members and for each of them, add 1 address 
        // using the address factory inside the closure. (1 to 1 relationship)
        factory(Member::class, 20)->create()->each(function ($member) {
            
            $member->address()->save(factory(Address::class)->make());
        });
    }
}
