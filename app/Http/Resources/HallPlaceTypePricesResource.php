<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HallPlaceTypePricesResource extends JsonResource
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
            'hall_id' => $this->hall_id,
            'place_type_id' => $this->place_type_id,
            'price' => $this->price,
        ];
    }
}