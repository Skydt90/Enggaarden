<?php

use App\Models\ActivityType;
use App\Models\Contribution;
use Illuminate\Database\Seeder;

class ContributionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contribution::query()->truncate();

        $contributionCount = (int) $this->command->ask('How many contributions should be created?', 100);
        
        $activityTypes = ActivityType::all();
        $atMax = count($activityTypes);

        factory(Contribution::class, $contributionCount)->make()->each(function ($contribution) use ($atMax){
            $contribution->activity_type_id = rand(1, $atMax);
            $contribution->save();
        });
    
    }
}
