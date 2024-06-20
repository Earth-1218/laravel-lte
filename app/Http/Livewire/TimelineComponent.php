<?php
// app/Http/Livewire/TimelineComponent.php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\LoanHistory;

class TimelineComponent extends Component
{
    public $user;
    public $loan_history;

    public function mount()
    {
        $this->user = auth()->user();
        $this->loan_history = LoanHistory::where('user_id', $this->user->id)->get();
    }

    public function render()
    {
        return view('timeline', [
            'loan_history' => $this->loan_history,
        ])->extends('layouts.app');
    }
}
