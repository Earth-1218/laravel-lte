<?php 

namespace App\Http\Livewire;

use Livewire\Component;

class TimelineComponent extends Component
{
    use HasLivewireAuth, HasTable;
    
    protected $queryString = [
        'perPage',
        'sortDirection',
        'search',
    ];

    public function render()
    {   
        return view('timeline')->extends('layouts.app');;
    }
}
