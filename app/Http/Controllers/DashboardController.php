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

    public function index(Request $request = null) {
        if ( ! ( $request->isMethod('post') ) ) {
            $type = 1;
            $date = date('Y-m');
            $method = 'monthly';
        } else {
            $input = $request->all();

            $type = $input['type'];
            $method = $input['method'];

            $date = $method == 'monthly' ? $input['month'] : $input['week'];
        }

        /* 수입 차트 */
        $charts = \App\Account::with('category')
            ->select('category_id')
            ->selectRaw('sum(amount) as sum')
            ->where('user_id', Auth::user()->id)
            ->where('type', $type)
            ->where($method == 'monthly' ? DB::raw('DATE_FORMAT(date, "%Y-%m")') : DB::raw('DATE_FORMAT(date, "%Y-W%V")'), $date)
            ->groupBy('category_id')
            ->get();
        $chartData = Lava::DataTable();

        $chartData->addStringColumn('카테고리')
            ->addNumberColumn('금액');

        foreach ($charts as $data) {
            $chartData->addRow(array($data->category->name, $data->sum));
        }

        $dashboard = $charts->count() > 0 ? Lava::ColumnChart('dashboard', $chartData, [
            'height' => 400,
            ]) : '';

        if( $request->isMethod('post') ){
            return view('dashboard.index', compact('type', 'date', 'method', 'dashboard', 'charts'));
        }

        return view('dashboard.index', compact('type', 'date', 'method', 'dashboard', 'charts'));
    }
}
