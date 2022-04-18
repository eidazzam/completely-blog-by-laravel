<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    public function index()
    {
        $posts =Post::all();

        return PostResource::collection($posts);
    }

    public function show($postId)
    {

        $post= Post::find($postId);
  
          return new PostResource($post); 



    }





    public function store(StorePostRequest $request)
    {
        $data = request()->all();
    
        // return response()->json(['message' => 'Post created successfully']);
      $post=  Post::create([

            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator'],

        ]);
        return $post;
    }

}
