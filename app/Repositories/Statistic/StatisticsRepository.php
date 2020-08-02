<?php

namespace App\Repositories\Statistic;

use Carbon\Carbon;
use App\Models\Subscription;
use App\Repositories\BaseRepo;
use Illuminate\Support\Facades\DB;


class StatisticsRepository extends BaseRepo implements StatisticRepoInterface
{

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
        $total = 0;
        Subscription::latest()->get()->filter(function($sub) {
            if ($sub->pay_date === null) {
                return $sub->amount;
            }
        })->each(function($sub) use(&$total) {
            $total += $sub->amount;
        });
        return $total;
    }

    public function getTotalAmountForYear($year)
    {
        $total = 0;
        Subscription::where('pay_date', '>=', Carbon::parse("first day of January $year"))
                ->where('pay_date', '<=', Carbon::parse("last day of December $year"))
                ->whereNotNull('pay_date')
                ->pluck('amount')
                ->each(function($amount) use(&$total) {
                    $total += $amount;
                });
        return $total;
    }
}
