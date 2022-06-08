<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photographer extends Model
{
    use HasFactory;
    protected $fillable = ['pexel_photographer_id', 'pexel_photographer_url', 'pexel_photographer_name', 'pexel_alt'];
}
