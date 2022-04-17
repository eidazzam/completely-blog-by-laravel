@extends('layouts.app')

@section('title')
Edit a Comment
@endsection

@section('content')
<div class=''>
    <h1 class="fs-1 mt-3">{{$post['title']}} <span class="text-content-base ">{{$post->user ? $post->user->name : 'unknown'}}</span></h1>
    <p class="fs-4">Created At: {{\Carbon\Carbon::parse($post['created_at'])->format('M-d-Y');}}</p>
    <p class="fs-6 mt-4">{{$post['description']}}</p>
</div>
<div class='mt-20 max-w-2xl'>
    @foreach ($post->comments as $cmnt)
    <div class='my-4 border p-4 rounded-lg'>
        <h2 class='text-lg fw-bold'>{{$cmnt->user->name}}</h2>
        <p class='text-lg my-2 fs-2'>{{$cmnt->body}}</p>
        <span class='text-sm '>last updated {{$cmnt->updated_at->toDayDateTimeString()}}</span>
        <div class="mt-4  flex">
            <form class="text-center d-inline" method='POST' action={{route('comments.delete', ['postId' => $post['id'], 'commentId' => $comment->id])}}>
                @csrf
                @method('DELETE')
                <button type="sumbit" class='btn btn-lg btn-danger'>Delete</button>
            </form>
            <a class='btn btn-lg btn-primary ml-4' href={{route('comments.view', ['postId' => $post['id'], 'commentId' => $cmnt->id])}}>
                Edit
            </a>
        </div>
    </div>
    @endforeach
    <div class='flex flex-col mt-6  p-4 rounded-lg'>
        <form method="POST" action={{route('comments.update', ['postId' => $post['id'], 'commentId' => $comment->id])}}>
            @csrf
            @method('PATCH')
            <label for="exampleFormControlInput1" class="form-label fs-2">Edit comment</label>
            <input class="form-control form-control-lg" type="text" placeholder="Edit comment" value={{$comment["body"]}} name="comment" id="coment" aria-label=".form-control-lg example">
            <button type="submit" class="btn btn-primary btn-lg mt-3">Edit comment</button>
        </form>
    </div>
</div>
@endsection