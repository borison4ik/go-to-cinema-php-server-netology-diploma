<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;
    protected $table = 'films';
    protected $guarded = false;
    protected $hidden = ['created_at', 'deleted_at', 'updated_at'];
}