@extends('layouts.app')

@section('content')
<div class="container vh-100 create-container">
    <form method="POST" enctype="multipart/form-data" action="{{ route('store') }}" class="create-form">
      @csrf

        <h2 class="mt-3">Create a New Post</h2>

        <div class="form-group mt-4">
          <label>File Input</label>
          <input type="file" class="form-control-file" name="image">
        </div>

        <div>
          <textarea name="caption" rows="2" class="form-control mt-4" placeholder="write a caption here..."></textarea>
        </div>

        {{ csrf_field() }}
        <div class="text-right mt-4">
          <button type="submit" class="btn btn-warning btn-sm text-white">作成</button>
          <a href="{{ route('top') }}" class="btn btn-warning btn-sm text-white">キャンセル</a>
        </div>

    </form>
</div>
@endsection
