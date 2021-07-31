@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        @if (session('success'))
          <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        <div class="card">
          <div class="card-header">{{ __('user.profile') }}</div>
          <div class="card-body">
            <form method="POST" action="{{ route('users.update') }}" enctype='multipart/form-data'>
              @csrf
              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('auth.email_address') }}</label>

                <div class="col-md-6">
                  <input
                    id="email"
                    type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email"
                    value="{{ old('email')??$user->email }}"
                    readonly
                    autocomplete="email"
                  >

                  @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('auth.name') }}</label>

                <div class="col-md-6">
                  <input
                    id="name"
                    type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    name="name"
                    value="{{ old('name')??$user->name }}"
                    required
                    autocomplete="name"
                    autofocus
                  >

                  @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('user.avatar') }}</label>

                <div class="col-md-6">
                  <img
                    class='form-control'
                    src='{{Storage::url($user->avatar)}}'
                    width='64'
                    height='64'
                    style='width: 84px;height: 84px;padding: 10px;margin-bottom: 4px;'
                  />
                  <input
                    id="avatar"
                    type="file"
                    class="form-control @error('avatar') is-invalid @enderror"
                    name="avatar"
                    value="{{ old('avatar')??$user->avatar }}"
                    accept='image/*'
                  >

                  @error('avatar')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('user.update') }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
