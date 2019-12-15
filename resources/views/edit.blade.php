@extends('layouts.app')

@section('content')
<div class="container vh-100 edit-container">
    <form method="POST" enctype="multipart/form-data" action="{{ route('update',['id'=>$post->id]) }}" class="create-form">
      @csrf

        <h2 class="mt-3">Edit a Post</h2>

        <div class="form-group mt-4">
          <img src="data:image/png;base64,{{ $post->image }}" class="w-100 h-100">
        </div>

        <div>
          <textarea name="caption" rows="3" class="form-control mt-4" placeholder="write a caption here...">{{ $post->caption }}</textarea>
        </div>

        {{ csrf_field() }}
        <div class="text-right mt-4">
          <button type="submit" class="btn btn-warning btn-sm text-white">更新</button>
          <a href="{{ route('top') }}" class="btn btn-warning btn-sm text-white">キャンセル</a>
        </div>

    </form>
</div>
@endsection
