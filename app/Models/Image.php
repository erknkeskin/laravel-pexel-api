<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'photo_id',
        'pexel_original',
        'pexel_large2x',
        'pexel_large2x',
        'pexel_large',
        'pexel_medium',
        'pexel_small',
        'pexel_portrait',
        'pexel_landscape',
        'pexel_tiny'
    ];
}
