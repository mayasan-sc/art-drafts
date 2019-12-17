@extends('layouts.app')

@section('content')
<div class="container vh-100 edit-profile-container">

    <form method="POST" enctype="multipart/form-data" action="{{ route('update_user',['id'=>$user->id]) }}" class="create-form">
      @csrf

        <div class="d-flex">
          @if ($user->user_icon !== null)
            <img src="data:image/png;base64,{{ $user->user_icon }}" class="user-icon mr-3"> 
          @else
            <div class="user-icon mr-3"></div>
          @endif

          <h2 class="mt-3">Edit a Profile</h2>
        </div>

        <div class="form-group mt-4">
          <div>
            <label>Icon</label>
            <input type="file" class="form-control-file" name="user_icon">
          </div>
        </div>

    
        <div class="form-group">
          <label for="name" class="col-form-label">{{ __('Name') }}</label>
          <div>
              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>

              @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
      </div>

      <div class="form-group">
          <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>
          <div>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
      </div>

      <div class="form-group">
          <label for="password" class="col-form-label">{{ __('Password') }}</label>
          <div>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
      </div>

      <div class="form-group">
          <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>
          <div>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
          </div>
      </div>

      <div class="form-group text-right">
          <button type="submit" class="btn btn-primary">
              更新
          </button>
      </div>

    </form>
</div>
@endsection
