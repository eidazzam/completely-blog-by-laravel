@extends('layouts.app')

@section('title')Update @endsection

@section('content')
<form method="POST" action="{{route('posts.update',['post' => $post->id])}}," enctype="multipart/form-data">
  @csrf
  @method('PUT')"
  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Title</label>
    <input name="title" type="text" value="{{$post['title']}}" class="form-control" id="exampleFormControlInput1">
  </div>
  <div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
    <textarea name='description' class="form-control" id="exampleFormControlTextarea1" rows="3">
    {{$post['description']}}
    </textarea>
  </div>
  <div class="my-3 fs-3">
    <input class="form-control form-control-lg" name="image" id="formFileLg" type="file">
  </div>
  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Post Creator</label>
    <select name='post_creator' class="form-control">
      @foreach ($users as $user)
      <option value="{{$user->id}}" @if($user->id == $post->user_id) selected @endif >{{$user->name}}</option>
      @endforeach
    </select>
  </div>


  <div class="mb-3">
    <button type="submit" class="btn btn-success">Update Post</button>
  </div>
</form>
@endsection