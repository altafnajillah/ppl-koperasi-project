<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = ['id'];

    protected $casts = [
        'dibaca' => 'boolean',
        'tanggal'=> 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
