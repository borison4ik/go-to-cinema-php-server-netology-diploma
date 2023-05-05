<?php

namespace App\Http\Controllers\API\AdminPanel;

use DateTime;
use App\Models\FilmSession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FilmSessionRequest;
use App\Http\Resources\FilmSessionResourceCollection;

class FilmSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $param = $request->all();
        $date = $param['date'] ?? null;

        if(!empty($date)){

            $dateTime = new DateTime($date);

            $filmSessions = FilmSession::whereDate('start_date_time', '=', $dateTime->format('Y-m-d'))->get();
            $filmSessionsCollection = $filmSessions->mapWithKeys(fn($fs) => [$fs['id'] => [
                'id' => $fs->id,
                'start_date_time' => $fs->start_date_time,
                'session_minutes' => $fs->session_minutes,
                'film_id' => $fs->film_id,
                'hall_id' => $fs->hall_id,
            ]]);
            return response()->json($filmSessionsCollection);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            '*.start_date_time' => 'required|date',
            '*.session_minutes' => 'required|integer',
            '*.film_id' => 'exists:films,id',
            '*.hall_id' => 'exists:halls,id',
        ]);

        // dd($request[0]['start_date_time']);
        $resultAddedSessions = [];

        foreach($data as $filmSession) {
            $addedSession = FilmSession::firstOrCreate([
                'start_date_time' => $filmSession['start_date_time'],
                'hall_id' => $filmSession['hall_id'],
            ], [
                'start_date_time' => $filmSession['start_date_time'],
                'session_minutes' => $filmSession['session_minutes'],
                'film_id' => $filmSession['film_id'],
                'hall_id' => $filmSession['hall_id'],
            ]);

            if ($addedSession) {
              array_push($resultAddedSessions, $addedSession);
            }
        }


        return response()->json($resultAddedSessions, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FilmSession  $filmSession
     * @return \Illuminate\Http\Response
     */
    public function show(FilmSession $filmSession)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FilmSession  $filmSession
     * @return \Illuminate\Http\Response
     */
    public function update(FilmSessionRequest $request, FilmSession $filmSession)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FilmSession  $filmSession
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = FilmSession::where('id', $id)->delete();

        if ($deleted) {
            return response()->json([ 'id' =>  (int)$id]);
        }
    }
}