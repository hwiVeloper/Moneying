<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;
use Auth;
use Validator;

class AssetsController extends Controller
{
    public function __construct() {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assets = \App\Asset::with('assetType', 'user')
                            ->where('user_id', Auth::user()->id)
                            ->get();

        $types = \App\AssetType::get();

        return view('asset.index', compact(
            'assets',
            'types'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validate($request, App\Asset::$rules);

        if ($validator) {
            return redirect('assets')->withErrors($validator)->withInput();
        }

        $asset = \App\Asset::create($request->all());

        // if fail
        if (! $asset) {
            return back()->with('flash_message', '오류가 발생했습니다. 관리자에게 문의해 주세요.')
                         ->withInput();
        }

        return redirect('assets')->with('flash_message', '등록되었습니다.');
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
    public function update(Request $request, $id)
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
        App\Asset::findOrFail($id)->delete();

        return redirect(route('assets.index'))->with('flash_message', '삭제되었습니다.');
    }
}
