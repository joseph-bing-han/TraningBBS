@extends('layouts.app')

@section('content')
  <div class='col-12'>
    <div class='card'>
      <div class='card-body'>
        <table>
          <tr>
            <td style='width: 74px;'>
              <img
                src='{{Storage::url($user->avatar)}}'
                width='64'
                height='64'
              />
            </td>
            <td>
              <h5>{{$user->name}}</h5>
              <div>{{__('user.intro',['id'=>$user->id,'time'=>$user->created_at])}}</div>
            </td>
          </tr>
        </table>
      </div>
    </div>
    <div class='card mt-2'>
      <div class='card-header py-1 bg-primary text-light'>
        {{$user->name}} {{__('post.created_posts')}}
      </div>
      <div class='card-body p-0'>
        <ul class="list-group list-group-flush">
          @foreach($posts as $post)
            <li class="list-group-item">
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
              <a class='card-link' href='{{route('posts.show',['category_id'=>$post->category_id, 'id'=>$post->id])}}'>
                {{$post->subject}}
              </a>

              <span class='badge badge-pill badge-secondary float-right'>{{$post->comment_amount}}</span>
              <div class='small'>
                {{$post->creator->name}} @ {{$post->updated_at}}
              </div>
            </li>
          @endforeach
        </ul>
      </div>
      <div class='card-footer py-1'>
        {{$posts->links()}}
      </div>
    </div>

    <div class='card mt-2'>
      <div class='card-header py-1 bg-secondary text-light'>
        {{$user->name}} {{__('post.commented_posts')}}
      </div>
      <div class='card-body p-0'>
        <ul class="list-group list-group-flush">
          @foreach($comments as $post)
            <div class='card'>
              <div class='card-header py-1'>
                {{__('post.commented')}} {{$post->parent->creator->name}} {{__('post.created_posts')}} >
                <a
                  class='card-link'
                  href='{{route('posts.index')}}'
                  data-toggle="tooltip"
                  title="{{__('post.click_category')}}"
                >
                  {{$post->parent->category->name}}
                </a>
                >
                <a
                  href='{{route('posts.show',['category_id'=>$post->category_id, 'id'=>$post->id])}}'
                >
                  {{$post->parent->subject}}
                </a>
              </div>
              <div class='card-body py-1'>
                @markdown($post->content)
              </div>
            </div>
          @endforeach
        </ul>
      </div>
      <div class='card-footer py-1'>
        {{$comments->links()}}
      </div>
    </div>
  </div>
@endsection
