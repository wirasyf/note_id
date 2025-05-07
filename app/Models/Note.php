<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'isi'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($note) {
            $note->judul = Str::title($note->judul);
        });

        static::updating(function ($note) {
            $note->judul = Str::title($note->judul);
        });
    }
}
