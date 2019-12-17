<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Like;


class LikesController extends Controller
{
    public function like(Request $request){

        $post_id = $request->post_id;
        $user_id = \Auth::user()->id;
        $like = Like::where('post_id',$post_id)
                     ->where('user_id',$user_id)
                     ->first();

        if ($like){
            $like->delete();
            return redirect()->back();
        } else{
            $like = new Like;
            $like->user_id = \Auth::user()->id;
            $like->post_id = $request->post_id;
            $like->save();
            return redirect()->back();
        }
    }    

    public function user_sum($user_id){
        $likes = Like::whereHas('Post',function($query) use ($user_id) {$query->where('user_id', $user_id);})->get();
        $likes_user_sum = $likes->count();

        return $likes_user_sum;
    }   

    public function post_sum($posts){

        $likes_post_sum = [];

        foreach($posts as $post){
            $num = 0;
            $post_id = $post->id;
            $like_records = Like::where('post_id', $post_id)->count();
            if ($like_records) $num = $like_records;
            $likes_post_sum[$post_id] = $num;
        }

        return $likes_post_sum;

    }

    public function like_users(Request $request){
        $like_users = Like::where('post_id', $request->post_id)->get();
        if (count($like_users) == 0){
            $like_users = '0';
        }
        return view('like_users' , ['like_users'=>$like_users]);
    }   
}
