<?php

namespace App\Http\Controllers\API\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Utils\IndexToKey;
use App\Models\HallPlaceTypePrice;
use App\Http\Controllers\Controller;
use App\Http\Requests\HallPlaceTypePriceRequest;

class HallPlaceTypePriceController extends Controller
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
    public function store(HallPlaceTypePriceRequest $request)
    {
//
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HallPlaceTypePrice  $hallPlaceTypePrice
     * @return \Illuminate\Http\Response
     */
    public function show(HallPlaceTypePrice $hallPlaceTypePrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HallPlaceTypePrice  $hallPlaceTypePrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HallPlaceTypePrice $hallPlaceTypePrice)
    {
        $data = $request->validate([
            '*.hall_id' => 'required|integer',
            '*.place_type_id' => 'required|integer',
            '*.price' => 'required|integer'
        ]);

        foreach ($data as $item) {
            HallPlaceTypePrice::updateOrCreate([
                'hall_id' => $item['hall_id'],
                'place_type_id' => $item['place_type_id'],
            ], $item);
        }

        return response()->json(IndexToKey::get(HallPlaceTypePrice::all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HallPlaceTypePrice  $hallPlaceTypePrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(HallPlaceTypePrice $hallPlaceTypePrice)
    {
        //
    }
}
