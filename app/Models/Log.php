<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $fillable = ['time','ip','user_agent','file_id','geolocation'];

    protected $casts = ['geolocation'=> 'array'];
}
