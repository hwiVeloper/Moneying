<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auth;
use Calendar;

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
    public function index()
    {
        $year = request()->get('year') ?: date('Y');
        $month = request()->get('month') ?: date('m');

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

        {cal_cell_content}<td><a href="{content}">{day}</a></td>{/cal_cell_content}
        {cal_cell_content_today}<td><div class="cal-highlight cal-today"><a href="{content}">{day}</a></div></td>{/cal_cell_content_today}

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
            'segments' => false
        ));

        $calendar = Calendar::generate($year, $month);


        $accounts = \App\Account::where('date', $year.'-'.$month.'-')->get();

        return view('account.index', compact('calendar', 'accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
