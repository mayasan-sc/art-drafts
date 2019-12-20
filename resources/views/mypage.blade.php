@extends('layouts.app')

@section('content')



  <div class="container mypage-container">

    <div class="d-flex align-items-end justify-content-center">
        @if ($user->user_icon !== null)
            <img src="data:image/png;base64,{{ $user->user_icon }}" class="user-icon mr-3"> 
        @else
            <div class="user-icon mr-3"></div>
        @endif
        <h2 class="mb-0">{{ $user->name }}</h2>
        <p class="mb-1 ml-3"><i class="fas fa-heart mr-2"></i>Total : {{ $like_user_sum }}</p>

        @if ($login_user_id == $user->id)
        <div class="mb-1 ml-2">

          <span class="ml-3 d-none d-md-inline-block">|</span>

          <a class="ml-3" href="{{ route('edit_mypage') }}">
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

    
    @if(count($posts) <= 3)
    <div class="vh-100">
    @endif

    @if (count($posts) > 0)
        <div class="row mt-5">
        @foreach ($posts as $post)
        <div class="col-4 text-left m-0 p-0" 
             data-toggle="modal" 
             data-target="#post-modal" 
             data-user="{{ $post->user->name }}" 
             data-user_icon="data:image/png;base64,{{ $post->user->user_icon }}"
             data-caption="{{ $post->caption }}" 
             data-image="data:image/png;base64,{{ $post->image }}"
             data-url="{{ route('mypage', ['user_id'=>$post->user->id]) }}"
             data-like_url="{{ route('like_users',['post_id'=>$post->id] )}}"
             data-like_num="{{ $likes_post_sum[$post->id] }}">
            <img src="data:image/png;base64,{{ $post->image }}" class="w-100 h-100">
        </div>  

        <!-- Post Modal-->
        <div class="modal fade" id="post-modal">
            <div class="modal-dialog" role="document">
              <div class="modal-content post modal-post">

                <div class="modal-header d-flex align-items-center">
                  <img id="user_icon" class="user-icon-sm mr-3">
                  <div id="user_icon_sub" class="d-none user-icon-sm mr-3"></div> 
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
                      <img id="post_image" class="w-100 h-100 mt-3"></img>
                      <p class="mt-3"></p>
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <form method="POST" action="{{ route('like', ['post_id'=>$post->id]) }}">
                            {{ csrf_field() }}
                            <button type="submit" style="border:none; background-color : transparent;"><i class="fas fa-heart mr-2"></i></button>
                        </form>
                        <a id="like_users"></a>
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


      @if(count($posts) <= 3)
      </div>
      @endif

      </div>
  </div>

@endsection
