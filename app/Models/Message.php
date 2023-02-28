<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'messages';

    //Add the below function
    public function friend()
    {
        return $this->belongsTo(User::class,'friend_id', 'id');
    }

    public function me()
    {
        return $this->belongsTo(User::class,'my_id', 'id');
    }
}
