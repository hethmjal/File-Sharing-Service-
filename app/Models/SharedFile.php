<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SharedFile extends Model
{
    use HasFactory;
    protected $fillable = ['title','message','sender_email','recipient_email'];

    public function files()
    {
        return $this->hasMany(File::class,'shared_file_id');
    }

    public function link()
    {
        return $this->hasOne(Link::class,'shared_file_id');
    }
}
