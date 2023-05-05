<?php

namespace App\Http\Controllers\API\AdminPanel;

use App\Models\Film;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\FilmRequest;
use App\Http\Resources\FilmResource;
use App\Http\Resources\FilmResourceCollection;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $films = Film::all();

        return new FilmResourceCollection($films);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FilmRequest $request)
    {
        $request->validate([
            'name' => 'required|string',
            'minutes' => 'required|string',
            'image' => 'required|file',
        ]);

        $imageName = Str::random(32) . '.' . $request->file('image')->getClientOriginalExtension();
        $imagePath = 'images/' . $imageName;
        $newFilm = Film::firstOrCreate([
            'name' => $request->name,
        ], [
            'name' => $request->name,
            'minutes' => (int)$request->minutes,
            'image' => url('storage/'.$imagePath),
        ]);

        $status = Storage::disk('public')->put($imagePath, file_get_contents($request->image));

        return response()->json([
            'id' => $newFilm['id'],
            'name' => $newFilm['name'],
            'minutes' => $newFilm['minutes'],
            'image' => $newFilm['image'],
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $film = Film::where('id', $id)->firstOrFail();
        return new FilmResource($film);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Film $film)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = Film::where('id', $id)->delete();

        if ($deleted) {
            return response()->json([ 'id' =>  (int)$id]);
        }
    }
}