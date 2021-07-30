<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  @stack('styles')
</head>
<body>
<div id="app">
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ url('/') }}">
        {{ config('app.name', 'Laravel') }}
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="{{ __('post.toggle_navigation') }}"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="nav navbar-nav">
          @foreach($categories as $category)
            <li class="nav-item">
              <a
                class="nav-link @if(Route::input('category_id')==$category->id) active @endif"
                href='{{route('posts.index',['category_id'=>$category->id])}}'
              >
                <span class="d-inline-block" data-toggle="tooltip" title="{{__('post.click_category')}}">
                {{$category->name}}
                </span>
              </a>
            </li>
          @endforeach
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
          <!-- Authentication Links -->
          @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('auth.login') }}</a>
            </li>
            @if (Route::has('register'))
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('auth.register') }}</a>
              </li>
            @endif
          @else
            <li class="nav-item dropdown">
              <a
                id="navbarDropdown"
                class="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
                v-pre
              >
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}">
                  <i class='fa fa-user-cog'></i>
                  {{__('auth.profile')}}
                </a>
                <a
                  class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                >
                  <i class='fa fa-sign-out-alt'></i>
                  {{ __('auth.logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  <main class="py-4">
    <div class='container-fluid'>
      <div class='row'>
        <div class='col-6 offset-2'>
          @yield('content')
        </div>
        <div class='col-2'>
          <div class='card'>
            <ul class="list-group list-group-flush">
              @auth
                <li class="list-group-item">
                  <a class='btn btn-link btn-sm text-decoration-none' href='/'>
                    <img src='{{Storage::url('avatar/'.auth()->user()->avatar)}}' width='48' height='48' />
                    {{auth()->user()->name}}
                  </a>
                </li>
              @endauth
              <li class="list-group-item">
                <a class='btn btn-sm' href='{{route('posts.create',['category_id'=>Route::input('category_id','')])}}'>
                  <i class='far fa-edit'></i>
                  {{__('post.create')}}
                </a>
              </li>
              <li class="list-group-item">
                <a class='btn btn-sm' href='/'>
                  <i class='fa fa-users'></i>
                  {{__('post.user_amount',['user_amount'=>$user_amount])}}
                </a>
              </li>
              <li class="list-group-item">
                <a class='btn btn-sm' href='/'>
                  <i class='fa fa-list'></i>
                  {{__('post.post_amount',['post_amount'=>$post_amount])}}
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

  </main>
</div>
@stack('scripts')
</body>
</html>
