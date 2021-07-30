@extends('layouts.app')
@section('content')
  <div class='col-12'>
    <div class='card'>
      <div class='card-header'>
        <div class='flex-column  justify-content-center'>
          <a
            class='card-link'
            href='{{route('posts.index')}}'
            data-toggle="tooltip"
            title="{{__('post.click_category')}}"
          >
            <span class='badge badge-info'>
                {{$post->category->name}}
            </span>
          </a>
          <a class='btn btn-link btn-sm text-decoration-none float-right' href='/'>
            <img src='{{Storage::url('avatar/'.$post->creator->avatar)}}' width='64' height='64' />
          </a>
          <h4>{{$post->subject}}</h4>
          {{__('post.updated_at')}}
          <a class='text-decoration-none' href='/'>
            {{$post->creator->name}}
          </a>@ {{$post->updated_at}}
        </div>
      </div>
      <div class='card-body'>
        {{$post->content}}
      </div>
    </div>
    <div class='my-2'></div>
    <div class="card">
      <div class='card-header py-2'>
        {{__('post.comment_amount',['comment_amount'=>$post->comment_amount])}}
      </div>
      <ul class="list-group list-group-flush">
        @foreach($comments as $post)
          <li class="list-group-item">
            <a class='btn btn-link btn-sm text-decoration-none float-left' href='/'>
              <img src='{{Storage::url('avatar/'.$post->creator->avatar)}}' width='48' height='48' />
            </a>
            <a class='text-decoration-none' href='/'>
              {{$post->creator->name}}
            </a>@ {{$post->updated_at}}
            <span class='badge badge-pill badge-secondary float-right'>
              #{{$loop->iteration}}
            </span>
            <p>@markdown($post->content)</p>
          </li>
        @endforeach
      </ul>
    </div>
    <div class='p-1'>
      {{$comments->links()}}
    </div>

    <div id="mdeditor">
      <textarea class="form-control" name="content" style="display:none;">
      </textarea>
    </div>
  </div>
@endsection
@push('styles')
  {!! editor_css() !!}
@endpush
@push('scripts')
  {!! editor_js() !!}
  {!! editor_config('mdeditor') !!}
@endpush
