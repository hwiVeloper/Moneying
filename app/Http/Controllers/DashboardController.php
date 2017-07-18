<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use LaravelHighchart;

class DashboardController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index($method = null) {
        $charts = [
            'chart' => ['type' => 'pie'],
            'title' => ['text' => 'fruit Consumption'],
            'xAxis' => [
                'categories' => ['apples' , 'bananas'],
            ],
            'yAxis' => [
                'title' => [
                    'text' => 'Fruit Eaten'
                ]
            ],
            'series' => [
                [
                    'name' => 'Reza',
                    'data' => [1,2]
                ],
                [
                    'name' => 'Kika',
                    'data' => [2,4]
                ],
            ]
        ];
        return view('dashboard.index', compact('charts'));
    }
}
