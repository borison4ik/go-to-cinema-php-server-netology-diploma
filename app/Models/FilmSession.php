<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmSession extends Model
{
    use HasFactory;
    protected $table = 'film_sessions';
    protected $guarded = false;
    protected $hidden = ['created_at', 'deleted_at', 'updated_at'];
}
