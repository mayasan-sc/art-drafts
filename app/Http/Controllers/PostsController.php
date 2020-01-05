<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Like;
use App\LikePostSum;
use Illuminate\Support\Facades\Hash;
class PostsController extends Controller
{

    public function welcome()
    {
        if (\Auth::user()) {
            return redirect()->route('top');
        } else {
            return view('welcome');
        }
    }

    public function top(Request $request)
    {

        $like = app()->make('App\Http\Controllers\LikesController');

        if (\Auth::user()) {
            $login_user_id = \Auth::user()->id;
        } else {
            $login_user_id = "";
        }

        if ($request->search){
            $keyword = $request->input('search');
            $posts = Post::orderBy('created_at', 'desc')
                           ->where('caption', 'like', '%'.$keyword.'%')
                           ->get();              
        } else if ($request->order == 'popular'){
            $posts = Post::withCount('like')
                         ->orderBy('like_count', 'desc')
                         ->get();
        } else {
            $posts = Post::orderBy('created_at', 'desc')->get();           
        }

        $likes_post_sum = $like->post_sum($posts);

        return view('top', ['login_user_id'=>$login_user_id, 'posts' => $posts, 'likes_post_sum' => $likes_post_sum]);
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request){

        $this->validate($request, [
            'image' => 'dimensions:ratio=1.0'
        ]);
        $post = new Post;
        $user = \Auth::user();
        $post->caption = request('caption');
        $post->image = base64_encode(file_get_contents($request->image->getRealPath()));
        $post->user_id = $user->id;
        $post->save();

        return redirect()->route('top');
    }

    public function mypage(Request $request){

        if($request->user_id) {
            $user = User::where('id', $request->user_id)->first();
            $login_user_id = '';
            if (\Auth::user()) $login_user_id = \Auth::user()->id;
        } else if (\Auth::user()){
            $user = \Auth::user();
            $login_user_id = \Auth::user()->id;
        }

        if($user){
            $posts = Post::whereHas('User',function($query) use ($user) {$query->where('user_id', $user->id);})
                                    ->orderBy('created_at','desc')
                                    ->get();

            $like = app()->make('App\Http\Controllers\LikesController');
            $likes_post_sum = $like->post_sum($posts);
            $like_user_sum = $like->user_sum($user->id);

            return view('mypage' , ['user'=>$user, 'login_user_id'=>$login_user_id, 'posts' => $posts, 'likes_post_sum' => $likes_post_sum, 'like_user_sum'=>$like_user_sum]);
        } else {
            return redirect()->route('top');
        }
    }

    public function edit_mypage(Request $request){
        $user = \Auth::user();
        if($user){
            return view('edit_mypage' , ['user'=>$user]);
        } else {
            return redirect()->route('top');
        }
    }

    public function update_user(Request $request)
    {
      $login_user_id = \Auth::user()->id;
      $update_user_id = $request->id; 
      if ($login_user_id == $update_user_id){
        $user = User::find($update_user_id);
        if ($request->user_icon){
            $user->user_icon = base64_encode(file_get_contents($request->user_icon->getRealPath()));
        }
        $user->name = request('name');
        $user->email = request('email'); 
        $user->password = Hash::make($request['password']);
        $user->update();
        return redirect()->route('mypage');
      } else {
        return redirect()->route('top');
      }

    }

    public function edit(Request $request){
        $user = \Auth::user();
        if ($user->id == $request->user_id){
            $post = Post::find($request->post_id);
            return view('edit', ['post' => $post,]);
        } else {
            return redirect()->route('top');
        }
    }

    public function update(Request $request)
    {
        $post = Post::find($request->id);
        $caption = $request->validate(['caption' => 'required']);
        $post->fill($caption)->save();
        return redirect()->route('top');
    }

    public function delete(Request $request)
    {
        $post = Post::find($request->id);
        $post->delete();
        return redirect()->route('top');
    }
}
