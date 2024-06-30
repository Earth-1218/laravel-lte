<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\TransactionCommission;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;
use DateInterval;
use DatePeriod;

class Chart
{
    public static function getChartData($startDate = null, $endDate = null)
    {
        // Set default start and end dates if not provided
        if (!$startDate) {
            $startDate = Carbon::now()->subDays(30)->toDateString();
        } else {
            $startDate = date('Y-m-d', strtotime($startDate));
        }
        
        if (!$endDate) {
            $endDate = Carbon::now();
        } else {
            $endDate = date('Y-m-d', strtotime($endDate));
        }
    

        // Prepare labels for timeline charts (assuming monthly data)
        $labels = [];
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);
        $interval = DateInterval::createFromDateString('1 month');
        $period = new DatePeriod($start, $interval, $end);

        foreach ($period as $dt) {
            $labels[] = $dt->format("F"); // Full month name, e.g., January
        }

        // Query to fetch transaction counts per month
        $transactionTimeline = Transaction::select(DB::raw('COUNT(*) as count, MONTH(date) as month'))
            ->whereBetween('date', [$startDate, $endDate])
            ->groupBy(DB::raw('MONTH(date)'))
            ->orderBy(DB::raw('MONTH(date)'))
            ->get();

        // Prepare data for transaction timeline chart
        $transactionTimelineData = [['name' => 'Transactions', 'data' => []]];
        foreach ($transactionTimeline as $item) {
            $transactionTimelineData[0]['data'][] = $item->count;
        }

        // Query to fetch transaction counts per category
        $transactionCategorywise = Transaction::select(DB::raw('COUNT(*) as count, platforms.category'))
            ->join('user_platforms', 'transactions.user_platform_id', '=', 'user_platforms.id')
            ->join('platforms', 'user_platforms.platform_id', '=', 'platforms.id')
            ->whereBetween('transactions.date', [$startDate, $endDate])
            ->groupBy('platforms.category')
            ->get();

        // Prepare data for transaction categorywise chart
        $transactionCategorywiseData = $transactionCategorywise->pluck('count')->map(function ($count) {
            return (float)$count;
        })->toArray();
        $transactionCategorywiseLabels = $transactionCategorywise->pluck('category')->map(function ($category) {
            return ucwords($category);
        })->toArray();

        // Query to fetch commission amounts per month
        $commissionTimeline = TransactionCommission::select(DB::raw('SUM(commission_amount) as sum, MONTH(created_at) as month'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        // Prepare data for commission timeline chart
        $commissionTimelineData = [['name' => 'Commissions', 'data' => []]];
        foreach ($commissionTimeline as $item) {
            $commissionTimelineData[0]['data'][] = $item->sum;
        }

        // Query to fetch commission amounts per category
        $commissionCategorywise = TransactionCommission::select(DB::raw('SUM(commission_amount) as sum, platforms.category'))
            ->join('transactions', 'transaction_commissions.transaction_id', '=', 'transactions.id')
            ->join('user_platforms', 'transactions.user_platform_id', '=', 'user_platforms.id')
            ->join('platforms', 'user_platforms.platform_id', '=', 'platforms.id')
            ->whereBetween('transaction_commissions.created_at', [$startDate, $endDate])
            ->groupBy('platforms.category')
            ->get();

        // Prepare data for commission categorywise chart
        $commissionCategorywiseData = $commissionCategorywise->pluck('sum')->map(function ($sum) {
            return (float) $sum;
        })->toArray();

        $commissionCategorywiseLabels = $commissionCategorywise->pluck('category')->map(function ($category) {
            return ucwords($category);
        })->toArray();

        // Return formatted chart data
        return [
            "transactionTimelineChart" => [
                "series" => $transactionTimelineData,
                "labels" => $labels,
            ],
            "transactionCategorywiseChart" => [
                "series" => $transactionCategorywiseData,
                "labels" => $transactionCategorywiseLabels,
            ],
            "commissionTimelineChart" => [
                "series" => $commissionTimelineData,
                "labels" => $labels,
            ],
            "commissionCategorywiseChart" => [
                "series" => $commissionCategorywiseData,
                "labels" => $commissionCategorywiseLabels,
            ],
        ];

        // $temp = [
        //     "transactionTimelineChart" => [
        //         "series" => [['name' => 'Transactions', 'data' => [30, 40, 35, 50, 49]]],
        //         "labels" => ['January', 'February', 'March', 'April', 'May']
        //     ],
        //     "transactionCategorywiseChart" => [
        //         "series" => [44, 55, 13, 43, 22],
        //         "labels" => ['Prepaid', 'Postpaid', 'Broadband', 'Fastag', 'Utilities']
        //     ],
        //     "commissionTimelineChart" => [
        //         "series" => [['name' => 'Commissions', 'data' => [20, 30, 25, 40, 39]]],
        //         "labels" => ['January', 'February', 'March', 'April', 'May']
        //     ],
        //     "commissionCategorywiseChart" => [
        //         "series" => [35, 45, 20, 50, 25],
        //         "labels" => ['Prepaid', 'Postpaid', 'Broadband', 'Fastag', 'Utilities']
        //     ]
        // ];
    }
}
