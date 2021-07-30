@extends('layouts.app')
@section('content')
  <form action='{{route('posts.save')}}' method='POST'>
    @csrf
    <div class='col-12'>
      <div class='card'>
        <div class='card-header p-1'>
          {{__('post.subject')}}
        </div>
        <div class='card-body p-0'>
          @error('subject')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
          <input
            name='subject'
            required
            maxlength='30'
            class='form-control @error('subject') is-invalid @enderror'
            placeholder='{{__('post.subject_placeholder')}}'
            value='{{old('subject')}}'
          >
        </div>
      </div>
      <div class="card mt-2">
        <div class='card-header p-1'>
          {{__('post.content')}}
        </div>
        <div class='card-body p-0'>
          @error('content')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
          <div id="mdeditor" class='@error('subject') is-invalid @enderror m-0'>
            <textarea class="form-control" name="content" style="display:none;">{{old('content')}}</textarea>
          </div>
        </div>
        <div class='card-footer'>
          @error('category_id')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
          <select
            class="form-control form-control-sm col-3 @error('category_id') is-invalid @enderror"
            required
            name='category_id'
          >
            <option value="" disabled>{{__('post.category_placeholder')}}</option>
            @foreach($categories as $category)
              <option
                value='{{$category->id}}'
                @if(Route::input('category_id')==$category->id) selected @endif>{{$category->name}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <button class='btn btn-primary mt-2 float-right'>
        <i class='fa fa-paper-plane'></i>
        {{__('post.submit')}}
      </button>
    </div>
  </form>
@endsection
@push('styles')
  {!! editor_css() !!}
@endpush
@push('scripts')
  {!! editor_js() !!}
  {!! md_editor_config('mdeditor', 360) !!}
@endpush
