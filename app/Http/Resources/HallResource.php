<?php

namespace App\Http\Resources;

use App\Models\UserPlace;
use Illuminate\Http\Resources\Json\JsonResource;

class HallResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $userPlaces = UserPlace::where('hall_id', $this->id)->get();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'rows' => $this->rows,
            'row_length' => $this->row_length,
            'user_places' => new UserPlaceResourceCollection($userPlaces)
        ];
    }
}
