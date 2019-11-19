<?php

use App\Models\Address;
use App\Models\Member;
use App\Models\Subscription;
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
        // delete all old data from db, since a rollback wont drop any tables
        Member::query()->truncate();
        Address::query()->truncate();
        Subscription::query()->truncate();

        $memberCount = (int) $this->command->ask('How many members should be created?', 50);

        // create 20 members and for each of them, add 1 address and 1% subs 
        // using their factories inside the closure. (1 to 1 and many relationship)
        factory(Member::class, $memberCount)->create()->each(function ($member) use ($memberCount) {
            
            $subCount = ceil($memberCount * 0.01);
            $member->address()->save(factory(Address::class)->make());
            $member->subscriptions()->saveMany(factory(Subscription::class, $subCount)->make());
        });

        factory(Member::class, ceil($memberCount * 0.2))->states('company')->create()->each(function ($member) use ($memberCount) {
            
            $subCount = ceil($memberCount * 0.01);
            $member->address()->save(factory(Address::class)->make());
            $member->subscriptions()->saveMany(factory(Subscription::class, $subCount)->make());
        });

    }
}
