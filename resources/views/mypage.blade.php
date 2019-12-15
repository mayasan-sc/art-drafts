@extends('layouts.app')

@section('content')



  <div class="container mypage-container vh-100">

    <div class="d-flex align-items-end justify-content-center">
      <h2 class="mb-0">{{ $user->name }}</h2>
        <p class="mb-1 ml-3"><i class="fas fa-heart mr-2"></i>Total : {{ $like_user_sum }}</p>

        @if ($login_user_id == $user->id)
        <div class="mb-1 ml-2">

          <span class="ml-3 d-none d-md-inline-block">|</span>

          <a class="ml-3" href="">
            <i class="fas fa-pen mr-1"></i>
            <span class="d-none d-md-inline-block">編集</span>
          </a>

          <a class="ml-3"
              href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt mr-1"></i>
            <span class="d-none d-md-inline-block">{{ __('Logout') }}</span>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>

        </div>
        @endif
    </div>
    
    @if (count($posts) > 0)
        <div class="row mt-5">
        @foreach ($posts as $post)
        <div type="button" 
             class="col-4 text-left m-0 p-0" 
             data-toggle="modal" 
             data-target="#post-modal" 
             data-user="{{ $post->user->name }}" 
             data-caption="{{ $post->caption }}" 
             data-image="data:image/png;base64,{{ $post->image }}"
             data-url="{{ route('mypage', ['user_id'=>$post->user->id]) }}" >
            <img src="data:image/png;base64,{{ $post->image }}" class="w-100">
        </div>  

        <!-- Post Modal-->
        <div class="modal fade" id="post-modal">
            <div class="modal-dialog" role="document">
              <div class="modal-content post modal-post">

                <div class="modal-header">
                  <a id="user"></a>
                  <button type="button" class="close" data-dismiss="modal" aria-label="閉じる"><span aria-hidden="true">&times;</span></button>
                </div>

                <div>
                    <div class="card-body">
                      @if ($login_user_id == $user->id)
                      <div class="d-flex justify-content-end edit-delete-btn">
                        <a href="{{ route('edit', ['post_id'=>$post->id, 'user_id'=>$post->user->id])}}">編集</a>
                        <span>　|　</span>
                        <a href="{{ route('delete', ['id'=>$post->id])}}">削除</a>
                      </div>
                      @endif
                      <img class="w-100 h-100 mt-3"></img>
                      <p class="mt-3"></p>
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <form method="POST" action="{{ route('like', ['post_id'=>$post->id]) }}">
                            {{ csrf_field() }}
                            <button type="submit" style="border:none; background-color : transparent;"><i class="fas fa-heart mr-2"></i></button>
                        </form>
                        <a href="">{{ $likes_post_sum[$post->id] }}</a>
                    </div>
                </div>

              </div>
          </div>
        </div>
        <!--END : Post Modal -->

        @endforeach
        </div>
    @else
    <div class="vh-100">
    </div>
    @endif


      </div>
  </div>

@endsection
