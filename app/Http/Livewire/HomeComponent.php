<?php 

namespace App\Http\Livewire;

use Livewire\Component;

class HomeComponent extends Component
{
    use HasLivewireAuth, HasTable;
    public $chartData = [];
    public $dateRange;
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

    public function updateChartData()
    {
        $this->resetPage();
    }

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
        $this->chartData = $this->getChartData();
    }

    public function updated()
    {
        $this->chartData = $this->getChartData();
    }
    

    public function render()
    {
        return view('home')
            ->extends('layouts.app');
    }  
    
    public function getChartData()
    {
        return [
            "transactionsPieChart" => [
                "series" => [44, 55, 13, 43, 22],
                "labels" => ['Apple', 'Mango', 'Orange', 'Watermelon', 'Banana']
            ],
            "transactionsDonutChart" => [
                "series" => [44, 55, 13, 43, 22],
                "labels" => ['Apple', 'Mango', 'Orange', 'Watermelon', 'Banana']
            ],
            "earningsChart" => [
                "series" => [['name' => 'Earnings', 'data' => [30, 40, 35, 50, 49]]],
                "labels" => ['January', 'February', 'March', 'April', 'May']
            ],
            "salesChart" => [
                "series" => [['name' => 'Sales', 'data' => [10, 41, 35, 51, 49]]],
                "labels" => ['January', 'February', 'March', 'April', 'May']
            ]
        ];
    }
}

