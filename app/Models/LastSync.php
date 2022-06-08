<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LastSync extends Model
{
    use HasFactory;
    public $table = "lastsync";
    protected $fillable = ['last_sync_date'];
}
