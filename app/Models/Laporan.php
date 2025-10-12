<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded  = ['id'];

    protected $casts = [
        'tanggal'=> 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
