<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    public $fillable = ['gambar', 'nama', 'slug','brand','dimensi','berat',
    'material','layar','os','soc','ramstorage','kamerautama','kameraultrawide',
    'kameratelephoto','kameraperiscope','makro','depth','kameradepan','videobelakang', 'videodepan','speaker',
    'audiojack','konektivitas','sensor','baterai','charging','harga'];
        protected $guarded = ['id'] ;//
}
