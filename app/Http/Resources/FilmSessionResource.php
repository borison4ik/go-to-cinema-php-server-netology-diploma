<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FilmSessionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'start_date_time' => $this->start_date_time,
            'session_minutes' => $this->session_minutes,
            'film_id' => $this->film_id,
            'hall_id' => $this->hall_id,
        ];
    }
}