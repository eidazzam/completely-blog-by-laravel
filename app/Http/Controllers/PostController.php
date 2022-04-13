<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorePostRequest;
class PostController extends Controller
{
    public function index()
    {
       $posts = Post::paginate(10);
       return view('posts.index',['allPosts'=>$posts]);


    }

    public function create()
    {
        $users = User::all();

        return view('posts.create',[
            'users' => $users,
        ]);
    }

    public function store(StorePostRequest $request)
    {
        $data = request()->all();
       
        Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator'],
        ]);

        return redirect()->route('posts.index');
        



    }

    public function show($post)
    {

               $posts = Post::find($post); 
               return view('posts.show',['posts'=>$posts]);
    }

    public function edit($post){


        $postToEdit = post::find($post); 
        $users = User::all();

        return view('posts.edit',['post'=>$postToEdit,'users'=>$users]);
    }

    public function update(Request $request, $post){
        $postToUpdate = post::find($post);
        $postToUpdate->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->post_creator,
        ]);

        // return to_route('posts.index');
        return redirect()->route('posts.index');
        
    }


    public function destroy ($post){

        $postToDelete = Post::find($post);
        $postToDelete->delete();
        $postToDelete->Comments()->delete();

        return redirect()->route('posts.index');
       }
}