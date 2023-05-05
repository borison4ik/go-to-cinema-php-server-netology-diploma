<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlace extends Model
{
    use HasFactory;

    protected $table = 'user_places';
    protected $guarded = false;
}