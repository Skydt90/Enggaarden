<?php

namespace App\Services;

use App\Contracts\ContributionServiceContract;
use App\Contracts\StatisticsRepositoryContract;
use App\Models\Contribution;
use Illuminate\Support\Facades\DB;

class StatisticsRepository implements StatisticsRepositoryContract
{
    private $contributionService;

    public function __construct(ContributionServiceContract $contributionService)
    {
        $this->contributionService = $contributionService;
    }

    public function getContributionsGrouped()
    {
        return DB::select("select activity_types.activity_type, SUM(contributions.amount) AS total_amount
        FROM contributions
        inner JOIN activity_types ON activity_types.id=contributions.activity_type_id
        GROUP BY activity_type");
    }

    public function getMembersAdded()
    {
        $entries = DB::select("select concat(year(created_at), '-', month(created_at)) as month, COUNT(id) as number 
        FROM members
        GROUP BY month");
        // if month is only 1 number, insert 0 before so sort will be correct
        foreach($entries as $entry){
            $entry->month = (strlen($entry->month) < 7) ? str_replace("-", "-0", $entry->month) : $entry->month;
        }

        asort($entries);

        return $entries;
    }

    public function getAmountNotPaid()
    {
        return DB::select('select SUM(subscriptions.amount) as owed from subscriptions where subscriptions.pay_date IS null')[0];  
    }

    

}