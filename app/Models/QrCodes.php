<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCodes extends Model
{
    use HasFactory;
    protected $table = 'qr_codes';
    protected $guarded = false;
    protected $hidden = ['created_at', 'deleted_at', 'updated_at'];

    public function tikets()
    {
        return $this->hasMany(Tiket::class);
    }
}