<?php

namespace App\Http\Controllers;

use App\Models\QrCodes;
use Illuminate\Http\Request;

class QrCodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QrCodes  $qrCodes
     * @return \Illuminate\Http\Response
     */
    public function show(QrCodes $qrCodes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QrCodes  $qrCodes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QrCodes $qrCodes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QrCodes  $qrCodes
     * @return \Illuminate\Http\Response
     */
    public function destroy(QrCodes $qrCodes)
    {
        //
    }
}