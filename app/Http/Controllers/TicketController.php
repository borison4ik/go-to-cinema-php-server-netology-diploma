<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\Ticket;
use App\Models\QrCodes;
use App\Models\FilmSession;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Utils\IndexToKey;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\SvgWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Label\Font\NotoSans;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;

class TicketController extends Controller
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
        $data = $request->validate([
            'film_session_id' => 'exists:film_sessions,id',
            'userPlaces.*.id' => 'exists:user_places,id',
            'userPlaces.*.place_row' => 'required|integer',
            'userPlaces.*.place_number' => 'required|integer',
            'userPlaces.*.hall_id' => 'exists:halls,id',
            'userPlaces.*.place_type_id' => 'exists:place_types,id',
        ]);

        $isOrdered = [];

        foreach($data['userPlaces'] as $key => $up) {
            $isOrderedTikets = Ticket::where(
                'film_session_id', $data['film_session_id'],
            )->where('user_place_id', $up['id'])->get();

            if(count($isOrderedTikets)){
                array_push($isOrdered, $isOrderedTikets);
            }
        }

        if (count($isOrdered)) {
            return response()->json([
                'message' => 'Билеты на выбранные вами места уже куплены'
            ], 301);
        }

        $isCreated = [];

        $session = FilmSession::where('id', $data['film_session_id'])->get()[0];
        $hall = Hall::where('id', $session['hall_id'])->get()[0];

        $startDate = $session['start_date_time'];
        $placeTemplate = 'место %{p}%, ряд %{r}%';
        $strPlaces = [];

        foreach ($data['userPlaces'] as $key => $up) {
            $strPlaces[] = str_replace(['%{p}%', '%{r}%'], [$up['place_number'], $up['place_row']], $placeTemplate);
        }

        $places = implode(', ', $strPlaces);
        $qrText = "Места: $places. Зал: $hall->name. Начало сеанса: $startDate";

        $qrName = Str::random(32) . '-' . $data['film_session_id'] . '-' . $up['id'] . '-' . '.svg';

        $qrPath = 'qr-codes/' . $qrName;

        $qrImageBuilder = Builder::create()
                ->writer(new SvgWriter())
                ->writerOptions([])
                ->data($qrText)
                ->encoding(new Encoding('UTF-8'))
                ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
                ->size(300)
                ->margin(3)
                ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
                ->validateResult(false)
                ->build();

        $status = Storage::disk('public')->put($qrPath, $qrImageBuilder->getString());

        if (!$status) {
            return response()->json([
                'message' => 'Ошибка QR кода'
            ], 301);
        }

        $qr = QrCodes::create([
            'qr_url' => $qrPath
        ]);

        foreach($data['userPlaces'] as $key => $up) {
            $ticket = Ticket::firstOrCreate([
                'film_session_id' => $data['film_session_id'],
                'user_place_id' => $up['id']
            ], [
                'qr_code_id' => $qr->id
            ]);

            array_push($isCreated, $ticket);
        }

        return response([
            'tikets'=>$isCreated,
            'qrUrl' => url('storage/'. $isCreated[0]->qrCode->qr_url)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show($sessionId)
    {
        $tickets = Ticket::where('film_session_id', $sessionId)->get();

        if (empty($tickets)) {
            return response([
                'message' => 'Нет билетов'
            ], 301);
        }
        return response(IndexToKey::get($tickets), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
