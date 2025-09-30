<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Illuminate\Http\Request;


class LikeController extends Controller
{
    public function toggle(Phone $phone)
    {
     
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

       

        // //return Inertia::render(
        //     'View',
        //     [
        //         'liked' => $,
        //         'active' => 'brand',
        //         'phoneId' => $phone->id,
        //         'likedByUser' => $phone->isLikedBy(auth()->user()),
        //         'likeCountInitial' => $phone->likes()->count(),
                
        //     ]
        // );
    }
}
