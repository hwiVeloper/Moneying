<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Calendar;
use Response;
use Input;

class AccountsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($year = null, $month = null, $date = null)
    {
        if($year  == null) $year  = date('Y');
        if($month == null) $month = date('m');
        if($date  == null) $date  = date('d');

        $ym      = $year.'-'.$month;
        $ymd     = $year.'-'.$month.'-'.$date;
        $red_ymd = $year.'/'.$month.'/'.$date;

        $dates = array();

        for($i = 0; $i <=  date('t', strtotime($ymd)); $i++)
        {
            array_push($dates, route('accounts.index'). '/' .date('Y') . "/" . date('m') . "/" . str_pad($i, 2, '0', STR_PAD_LEFT));
        }

        unset($dates[0]);

        $template = '
        {table_open}<table class="table cal-table" border="0" cellpadding="0" cellspacing="0">{/table_open}

        {heading_row_start}<tr>{/heading_row_start}

        {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
        {heading_title_cell}<th colspan="5">{heading}</th>{/heading_title_cell}
        {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

        {heading_row_end}</tr>{/heading_row_end}

        {week_row_start}<tr>{/week_row_start}
        {week_day_cell}<td class="cal-weekrow">{week_day}</td>{/week_day_cell}
        {week_row_end}</tr>{/week_row_end}

        {cal_row_start}<tr>{/cal_row_start}
        {cal_cell_start}{/cal_cell_start}

        {cal_cell_content}<td><a class="cal-link" href="{content}">{day}</a></td>{/cal_cell_content}
        {cal_cell_content_today}<td class="cal-today"><div><a href="{content}">{day}</a></div></td>{/cal_cell_content_today}

        {cal_cell_no_content}<td>{day}</td>{/cal_cell_no_content}
        {cal_cell_no_content_today}<td class="cal-today"><div class="cal-highlight">{day}</div></td>{/cal_cell_no_content_today}

        {cal_cell_blank}<td>&nbsp;</td>{/cal_cell_blank}

        {cal_cell_end}{/cal_cell_end}
        {cal_row_end}</tr>{/cal_row_end}

        {table_close}</table>{/table_close}
        ';

        Calendar::initialize(array(
            'template' => $template,
            'show_next_prev' => true,
            'segments' => true,
            'next_prev_url' => 'http://hwi.mismaven.kr/accounts'
        ));

        $calendar = Calendar::generate($year, $month, $dates);

        $accounts = \App\Account::with('category', 'asset')
                                ->where('date', $year.'-'.$month.'-'.$date)
                                ->where('user_id', Auth::user()->id)
                                ->get();

                                // dd($accounts);
        $assets = \App\Asset::where('user_id', Auth::user()->id)->get();
        $asset_count = \App\Asset::where('user_id', Auth::user()->id)->count();
        $categories = \App\Category::where('type', 1)->get();

        return view('account.index', compact(
            'calendar',
            'accounts',
            'assets',
            'asset_count',
            'categories',
            'ymd',
            'red_ymd',
            'date'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $account = \App\Account::create($request->all());

        // if fail
        if (! $account) {
          return back()->with('flash_message', '오류가 발생했습니다. 관리자에게 문의해 주세요.')
                       ->withInput();
        }

        return redirect('accounts/' . Input::get('red_ymd'))->with('flash_message', '저장되었습니다.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        echo "destroy";
    }

    public function changeType(Request $request)
    {
        $response = "";
        $categories = \App\Category::where('type', Input::get('type'))
                                   ->get();
        foreach ($categories as $category) {
            $response .= "<option value='$category->id'>$category->name</option>";
        }
        return Response::make($response);
    }
}
