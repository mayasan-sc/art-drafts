@extends('layouts.app')

@section('content')
<div class="container vh-100 like-users-container">
    <div class="like-users">
      <h2 class="mt-3">This post is liked by ...</h2>

      <hr>

      @if($like_users == "0")
        <p>The is no user yet</p>
      @else 
        @foreach ($like_users as $like_user)
        <div class="d-flex align-items-center mt-3">
          @if ($like_user->user_icon !== null)
              <img src="data:image/png;base64,{{ $like_user->user_icon }}" class="user-icon-sm mr-3"> 
          @else
              <div class="user-icon-sm mr-3"></div>
          @endif
          <p class="mb-0">{{$like_user->user->name}}</p>
        </div>
        @endforeach
      @endif

      <div class="text-right mt-5">
        <a href="{{ route('top') }}" class="btn btn-warning btn-sm text-white">戻る</a>
      </div>

    </div>
</div>

@endsection
