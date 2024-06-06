<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $chartData = [
            '2021-01-01' => 30,
            '2021-01-02' => 40,
            '2021-01-03' => 35,
            // Add more data points here
        ];

        return view('home',compact('chartData'));
    }
}
