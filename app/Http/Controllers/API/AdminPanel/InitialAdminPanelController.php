<?php

namespace App\Http\Controllers\API\AdminPanel;


use App\Models\Film;
use App\Models\Hall;
use App\Models\PlaceType;
use App\Models\UserPlace;
use App\Models\FilmSession;
use Illuminate\Http\Request;
use App\Http\Utils\IndexToKey;
use App\Models\HallPlaceTypePrice;
use App\Http\Controllers\Controller;
use App\Http\Resources\InitialAdminResource;
use App\Http\Resources\FilmResourceCollection;
use App\Http\Resources\HallResourceCollection;
use App\Http\Resources\UserPlaceResourceCollection;
use App\Http\Resources\PlaceTypesRecourceCollection;
use App\Http\Resources\FilmSessionResourceCollection;
use App\Http\Resources\HallPlaceTypePricesResourceCollection;

class InitialAdminPanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $halls = Hall::all();
        $userPlaces = UserPlace::all();
        $hallPlaceTypePrices = HallPlaceTypePrice::all();
        $filmSessions = FilmSession::all();
        $films = Film::all();
        $placeTypes = PlaceType::all();

        $newHalls = [];
        foreach ($halls as $hall) {
            // $indexedHalls[$up['hall_id']]['userPlaces'][$up['id']] = $up;
            $tempHallArray = [
                'id' => $hall->id,
                'name' => $hall->name,
                'rows' => $hall->rows,
                'row_length' => $hall->row_length,
                'enabled' => $hall->enabled,
            ];
            // $tempHallArray = $hall->toArray();
            $tempHallArray['userPlaces'] = IndexToKey::get($hall->userPlaces);
            $newHalls[$tempHallArray['id']] = $tempHallArray;

        }


        $data = [
            'halls' => $newHalls,
            'hallPlaceTypePrices' => IndexToKey::get($hallPlaceTypePrices),
            'film_sessions' => IndexToKey::get($filmSessions),
            'films' => IndexToKey::get($films),
            'place_types' => IndexToKey::get($placeTypes)
        ];

        return response()->json($data);
    }

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
        //
    }
}