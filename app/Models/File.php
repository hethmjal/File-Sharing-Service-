<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = ['path','type','shared_file_id'];

    public function shared_file()
    {
       return $this->belongsTo(SharedFile::class,'shared_file_id');
    }
}
