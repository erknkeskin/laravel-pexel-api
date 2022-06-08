<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    public $table = "photos";
    protected $fillable = ['photographer_id', 'pexel_photo_id', 'pexel_url', 'pexel_width', 'pexel_height', 'pexel_liked'];

    public function getImage()
    {
        return $this->hasOne('App\Models\Image', 'photo_id', 'id');
    }
}
