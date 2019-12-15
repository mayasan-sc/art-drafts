@extends('layouts.app')

@section('content')

<div class="container top-container">

    <div class="m-0 sort">
        <i class="fas fa-sort-amount-down"></i>
        <a class="navbar-brand ml-2" href="{{ route('top') }}">New</a>
        <span>/</span>
        <a class="navbar-brand ml-3" href="{{ route('top',['order'=>'popular']) }}">Popular</a>
    </div>

    <div class="row">


        @foreach ($posts as $post)
        <div class="col-lg-4 text-left mt-4" 
             data-toggle="modal" 
             data-target="#post-modal" 
             data-user="{{ $post->user->name }}" 
             data-caption="{{ $post->caption }}" 
             data-image="data:image/png;base64,{{ $post->image }}"
             data-url="{{ route('mypage', ['user_id'=>$post->user->id]) }}">

          <div class="post" id="post">

            <div class="card-body">
              <a href="{{ route('mypage', ['user_id'=>$post->user->id]) }}"> {{ $post->user->name }} </a>
              <hr>
              <div class="text-center">
                <img src="data:image/png;base64,{{ $post->image }}">
              </div>
              <p class="mt-3 caption"> {{ $post->caption }} </p>
            </div>

            <div class="card-footer text-right">
                <div class="d-flex justify-content-end">
                    <form method="POST" action="{{ route('like', ['post_id'=>$post->id]) }}">
                        {{ csrf_field() }}
                        <button type="submit" style="border:none; background-color : transparent;"><i class="fas fa-heart mr-2"></i></button>
                    </form>
                    @if ($likes_post_sum[$post->id] > 0)
                        <a href="">{{ $likes_post_sum[$post->id]}}</a>
                    @else
                        <a href="">0</a>
                    @endif
                </div>
            </div>

          </div>

        </div>

        <!-- Post Modal-->
        <div class="modal fade" id="post-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content post modal-post">

                  <div class="modal-header">
                    <a id="user" href=""></a>
                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる"><span aria-hidden="true">&times;</span></button>
                  </div>

                  <div>

                      <div class="card-body">
                        @if ($login_user_id == $post->user->id)
                        <div class="d-flex justify-content-end edit-delete-btn">
                          <a href="{{ route('edit', ['id'=>$post->id])}}">編集　</a>
                          <span> | </span>
                          <a href="{{ route('delete', ['id'=>$post->id])}}">　削除</a>
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
        <!-- END : Post Modal -->
        @endforeach

      </div>
  </div>
@endsection
