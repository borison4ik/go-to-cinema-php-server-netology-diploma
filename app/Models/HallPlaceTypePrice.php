<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallPlaceTypePrice extends Model
{
    use HasFactory;
    protected $table = 'hall_place_type_prices';
    protected $guarded = false;
}