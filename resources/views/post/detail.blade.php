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
        @markdown($post->content)
      </div>
    </div>
    <div class="card mt-2">
      <div class='card-header py-2'>
        {{__('post.comment_amount',['comment_amount'=>$post->comment_amount])}}
      </div>
      <ul class="list-group list-group-flush">
        @foreach($comments as $comment)
          <li class="list-group-item">
            <a class='btn btn-link btn-sm text-decoration-none float-left' href='/'>
              <img src='{{Storage::url('avatar/'.$comment->creator->avatar)}}' width='48' height='48' />
            </a>
            <a class='text-decoration-none' href='/'>
              {{$comment->creator->name}}
            </a>@ {{$comment->updated_at}}
            <span class='badge badge-pill badge-secondary float-right'>
              #{{$loop->iteration}}
            </span>
            <p>@markdown($comment->content)</p>
          </li>
        @endforeach
      </ul>
    </div>
    <div class='p-1'>
      {{$comments->links()}}
    </div>
    @auth
      <form action='{{route('posts.update')}}' method='POST'>
        @csrf
        <input type='hidden' name='parent_id' value='{{$post->id}}'>
        <input type='hidden' name='category_id' value='{{$post->category->id}}'>
        <div class='card mt-2'>
          <div class='card-header py-1'>
            {{__('post.comment_post')}}
          </div>
          <div class='card-body p-0'>
            @error('content')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('parent_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('category_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div id="mdeditor" class=' m-0'>
              <textarea class="form-control" name="content" required style="display:none;">{{old('content')}}</textarea>
            </div>
            <button class='btn btn-info m-1 float-right'>
              {{__('post.comment')}}
            </button>
          </div>
        </div>

      </form>
    @endauth
  </div>
@endsection
@push('styles')
  @auth
    {!! editor_css() !!}
  @endauth
@endpush
@push('scripts')
  @auth
    {!! editor_js() !!}
    {!! md_editor_config('mdeditor', 360) !!}
  @endauth
@endpush
