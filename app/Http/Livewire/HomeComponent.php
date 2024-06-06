<?php 

namespace App\Http\Livewire;

use Livewire\Component;

class HomeComponent extends Component
{
    use HasLivewireAuth, HasTable;
    public $chartData = [];
    
    protected $queryString = [
        'perPage',
        'sortDirection',
        'search',
    ];

    public function mount()
    {
        $this->chartData = [
            '2021-01-01' => rand(1, 100),
            '2021-01-02' => rand(1, 100),
            '2021-01-03' => rand(1, 100),
        ];
    }

    public function updateChartData()
    {
        $this->resetPage();
    }

     /**
     * Reset pagination back to page one if search query is changed.
     *
     * @return void
     */
    public function updatedSearch()
    {
        $this->resetPage();
    }

    private function fetchChartData()
    {
        return [
            '2021-01-01' => rand(1, 100),
            '2021-01-02' => rand(1, 100),
            '2021-01-03' => rand(1, 100),
        ];
    }

    public function render()
    {   
        return view('home', ['chartData' => $this->chartData])
               ->extends('layouts.app');;
    }
}
