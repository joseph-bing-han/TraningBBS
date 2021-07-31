@extends('layouts.app')

@section('content')
  <div class='col-12'>
    <div class="accordion" id="accordion_posts">
      @foreach($posts as $post)
        <div class="card">
          <div class="card-header py-2" id="heading-post-{{$post->id}}">
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
            <button
              class="btn btn-link text-left collapsed"
              type="button"
              data-toggle="collapse"
              data-target="#collapse-post-{{$post->id}}"
              aria-expanded="false"
              aria-controls="collapse-post-{{$post->id}}"
            >
              {{$post->subject}}
            </button>
            <a href='{{route('posts.show',['category_id'=>$post->category_id, 'id'=>$post->id])}}'>
                <span class="d-inline-block" data-toggle="tooltip" title="{{__('post.click_view')}}">
                <i class="far fa-list-alt"></i>
                </span>
            </a>
            <span class='badge badge-pill badge-secondary float-right'>{{$post->comment_amount}}</span>
            <div class='small'>
              <a class='text-decoration-none' href='{{route('users.member',['id'=>$post->creator->id])}}'>
                {{$post->creator->name}}
              </a>
              @ {{$post->updated_at}}
            </div>
          </div>
          <div
            id="collapse-post-{{$post->id}}"
            class="collapse"
            aria-labelledby="heading-post-{{$post->id}}"
            data-parent="#accordion_posts"
          >
            <div class="card-body py-2">
              @markdown($post->content)
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <div class='p-1'>
      {{$posts->links()}}
    </div>
  </div>
@endsection
