<?php

namespace App\Models;

use App\Models\QrCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;
    protected $table = 'tickets';
    protected $guarded = false;
    protected $hidden = ['created_at', 'deleted_at', 'updated_at'];

    public function qrCode()
    {
        return $this->belongsTo(QrCode::class);
    }
}
