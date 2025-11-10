<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    public $fillable = ['gambar', 'nama', 'slug','brand','dimensi','berat',
    'material','layar','os','soc','ramstorage','kamerautama','kameraultrawide',
    'kameratelephoto','kameraperiscope','makro','depth','kameradepan','videobelakang', 'videodepan','speaker',
    'audiojack','konektivitas','sensor','baterai','charging','harga', 'backgroundSize', 'backgroundPosition'];
        protected $guarded = ['id'] ;//
    
        public function likes()
        {
            return $this->hasMany(Like::class);
        }

        public function isLikedBy(User $user)
        {
            return $this->likes()->where('user_id', $user->id)->exists();
        }

        public function comments()
        {
            return $this->hasMany(Comment::class)->latest();
        }

        public function user()
    {
        return $this->belongsTo(User::class);
    }
}
