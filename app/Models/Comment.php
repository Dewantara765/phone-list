<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Phone;

class Comment extends Model
{
    public $fillable = ['body', 'user_id', 'phone_id'];

    public function user()
{
    return $this->belongsTo(User::class);
}//
}
