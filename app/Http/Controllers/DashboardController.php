<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Lava;

class DashboardController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index($method = null) {
        if ($method == null) $method = "monthly";

        $incomeChartsCategories = [];
        $incomeChartsData = [];
        $expenseChartsCategories = [];
        $expenseChartsData = [];

        /* 수입 차트 */
        $incomes = \App\Account::with('category')
            ->select('category_id')
            ->selectRaw('sum(amount) as sum')
            ->where('user_id', Auth::user()->id)
            ->where('type', 1)
            ->groupBy('category_id')
            ->get();

        $incomeChartData = Lava::DataTable();

        $incomeChartData->addStringColumn('카테고리')
            ->addNumberColumn('금액');

        foreach ($incomes as $data) {
            $incomeChartData->addRow(array($data->category->name, $data->sum));
        }

        $incomeChart = Lava::BarChart('income', $incomeChartData);

        return view('dashboard.index');
    }
}
