<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceType extends Model
{
    use HasFactory;
    protected $table = 'place_types';
    protected $guarded = false;
    protected $hidden = ['created_at', 'deleted_at', 'updated_at'];
}
