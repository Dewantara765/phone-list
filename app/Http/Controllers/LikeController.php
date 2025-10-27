<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Illuminate\Http\Request;


class LikeController extends Controller
{
    public function toggle(Phone $phone)
    {
        if (!auth()->check()) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }
     
        $user = auth()->user();
   
        $like = $phone->likes()->where('user_id', $user->id)->first();

        if ($like) {
        $like->delete();
        $liked=false;
        } else {
            $phone->likes()->create(['user_id' => $user->id]);
            $liked=true;
        }

        $likeCount = $phone->likes()->count();
      
        
        return response()->json([
        'liked' => $liked,
        'like_count' => $phone->likes()->count(),
    ]);

    }
}
