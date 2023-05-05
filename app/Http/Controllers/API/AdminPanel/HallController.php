<?php

namespace App\Http\Controllers\API\AdminPanel;


use App\Models\Hall;
use App\Models\UserPlace;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;
use App\Http\Utils\IndexToKey;
use App\Http\Requests\HallRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $halls = Hall::all();

        $hallsCollection = $halls->mapWithKeys(fn($hall) => [$hall['id'] => [
            'id' => $hall->id,
            'name' => $hall->name,
            'rows' => $hall->rows,
            'row_length' => $hall->row_length,
            'enabled' => $hall->enabled
        ]]);

        return response()->json($hallsCollection->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string'
        ]);

        $hall = Hall::firstOrCreate([
            'name' => $request->name,
            'rows' => 0,
            'row_length' => 0,
            'enabled' => false,

        ]);

        return response()->json([
            'id' => $hall->id,
            'name' => $hall->name,
            'rows' => $hall->rows,
            'row_length' => $hall->row_length,
            'enabled' => $hall->enabled,
            'userPlaces' => IndexToKey::get($hall->userPlaces)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hall = Hall::where('id', $id)->first();

        return response()->json([
            'id' => $hall->id,
            'name' => $hall->name,
            'rows' => $hall->rows,
            'row_length' => $hall->row_length,
            'enabled' => $hall->enabled,
            'userPlaces' => IndexToKey::get($hall->userPlaces)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'rows' => 'required|integer',
            'row_length' => 'required|integer',
            'enabled' => 'required|boolean',
            'userPlaces.*.place_row' => 'required|integer',
            'userPlaces.*.place_number' => 'required|integer',
            'userPlaces.*.hall_id' => 'exists:halls,id',
            'userPlaces.*.place_type_id' => 'exists:place_types,id',
        ]);

        $hall = Hall::find($id);
        $hall->update([
            'rows' => $request->rows,
            'row_length' => $request->row_length,
            'enabled' => $request->enabled,
        ]);

        if (count($request->userPlaces) !== 0){
            foreach ($request->userPlaces as $key => $up) {
                UserPlace::updateOrCreate([
                    'hall_id' => $request->id,
                    'place_row' => $up['place_row'],
                    'place_number' => $up['place_number']
                ], [
                    'hall_id' => $request->id,
                    'place_row' => $up['place_row'],
                    'place_number' => $up['place_number'],
                    'place_type_id' => $up['place_type_id']
                ]);
            }
        }

        return response()->json([
            'id' => $hall->id,
            'name' => $hall->name,
            'rows' => $hall->rows,
            'row_length' => $hall->row_length,
            'enabled' => $hall->enabled,
            'userPlaces' => IndexToKey::get($hall->userPlaces)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $userPlaces = Hall::where('id', (int)$id)->first()->userPlaces;

        foreach($userPlaces as $up) {
            $up->delete();
        }

        $deleted = Hall::where('id', $id)->delete();

        if ($deleted) {
            return response()->json([ 'id' =>  (int)$id]);
        }
    }
}