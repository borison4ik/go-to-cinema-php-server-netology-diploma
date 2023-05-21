<?php

namespace App\Models;

use App\Models\UserPlace;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hall extends Model
{
    use HasFactory;
    protected $table = 'halls';
    protected $guarded = false;
    protected $hidden = ['created_at', 'deleted_at', 'updated_at'];


    public function userPlaces()
    {
        return $this->hasMany(UserPlace::class);
    }
}
