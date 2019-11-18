<?php

use App\Models\ActivityType;
use Illuminate\Database\Seeder;

class ActivityTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ActivityType::query()->truncate();

        $typeCount = (int) $this->command->ask('How many activity types should be created?', 20);
        
        factory(ActivityType::class, $typeCount)->create();
    }
}
