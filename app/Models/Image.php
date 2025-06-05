<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        "image_url",
        'note_id',
    ];

    public function note()
    {
        return $this->belongsTo(Note::class);
    }}
