<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Str;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index(){
        $posts= Post::with('User')->paginate(25);
        return PostResource::collection($posts);
    }
    public function show($postId){
        $post = Post::find($postId);
        return new PostResource($post);
    }
    public function store (PostRequest $request) {
        
        $data = request()->all();
        // dd($data);
       $post= Post::create([
            'title' => $data['title'],
            'description' =>$data['description'],
            'user_id' => $data['posted-by'],
            'slug' => str::slug($data['title'])
        ]);
        return new PostResource($post);
    }
}
