<?php 

namespace App\Http\Livewire;

use App\Models\TransactionCommission;
use Carbon\Carbon;
use App\Services\Chart;
use Livewire\Component;

class HomeComponent extends Component
{
    use HasLivewireAuth, HasTable;
    public $chartData = [];
    public $dateRange =     "";
    public $startDate;
    public $endDate;
    public $chartId;
    public $chartType;
    public $chartHeight;
    public $series;
    public $labels;
    
    protected $queryString = [
        'perPage',
        'sortDirection',
        'search',
        'dateRange',
    ];

    protected $listners = ['dateRangeUpdated' => 'dateRangeUpdated'];

    // public function updateChartData()
    // {
    //     $this->resetPage();
    // }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function mount($chartId, $chartType, $chartHeight = 350, $series = [], $labels = [])
    {
        $this->chartId = $chartId;
        $this->chartType = $chartType;
        $this->chartHeight = $chartHeight;
        $this->series = $series;
        $this->labels = $labels;
    
        if ($this->dateRange && strpos($this->dateRange, ' - ') !== false) {
            $dateRange = explode(' - ', $this->dateRange);
            $this->startDate = !empty($dateRange) ? $dateRange[0] : null;
            $this->endDate = !empty($dateRange) ? $dateRange[1] : null;
        } else {
            $this->startDate = null;
            $this->endDate = null;
        }
    
        $this->chartData = $this->getChartData($this->startDate, $this->endDate);
    }
    

    public function updated($chartId, $chartType, $chartHeight = 350, $series = [], $labels = [])
    {
        $this->chartId = $chartId;
        $this->chartType = $chartType;
        $this->chartHeight = $chartHeight;
        $this->series = $series;
        $this->labels = $labels;
    
        if ($this->dateRange && strpos($this->dateRange, ' - ') !== false) {
            $dateRange = explode(' - ', $this->dateRange);
            $this->startDate = !empty($dateRange) ? $dateRange[0] : null;
            $this->endDate = !empty($dateRange) ? $dateRange[1] : null;
        } else {
            $this->startDate = null;
            $this->endDate = null;
        }
    
        $this->chartData = $this->getChartData($this->startDate, $this->endDate);
    }
    

    public function render()
    {
        return view('home')
            ->extends('layouts.app');
    }  

    public function updateChartData()
    {
        // Fetch or update your series and labels data here
        $newSeries = $this->series;
        $newLabels = $this->labels;
        $this->resetPage();
        $this->emit('updateChart', $newSeries, $newLabels);
    }
    
    public function getChartData($startDate, $endDate)
    {
        
        $chartData = Chart::getChartData($startDate, $endDate);
        // echo '<pre>';
        // print_r($chartData); exit;
        // dd($chartData);
        // return $chartData;
        
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

        //  echo '<pre>';
        // print_r($temp); exit;
        return $chartData;
    }
}

