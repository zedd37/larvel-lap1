<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Str;
use App\Jobs\PruneOldPostsJob;

class postsController extends Controller
{
   
    public function index(){
    PruneOldPostsJob::dispatch();
        $allPosts = Post::with('User')->paginate(2);
        return view('posts.index', [
          'posts' => $allPosts
        ]);
    }
    public function show($postId){
       $post = Post::find($postId);
        return  view('posts.show',[
            'post' => $post
        ]);
    }
    public function create(){
        $allUsers= User::all();
        // dd($allUsers);
        return view('posts.create',[
            'users' => $allUsers
        ]);
    }
    public function store(PostRequest $request){
        $data = new Post();
        // dd($data);
        if($request->hasfile("image")){
            $file = $request->file('image');
            $extention=$file->getClientOriginalExtension();
            $file_name= time(). ".". $extention;
            $file->move('posts/image',$file_name);
            $data['image']=$file_name;
            Post::create([
                'title' => $data['title'],
                'description' =>$data['description'],
                'user_id' => $data['posted-by'],
                'slug' => str::slug($data['title']),
                'image'=> $data['image']
            ]);
        }else {
            return $request;
            $data['image']='';
        }
        $data->save();
     
       return redirect()->route('posts.index');
    }
    public function edit($postId ) {
        $post = Post::find($postId);
        return view('posts.edit',[
            'post' => $post
        ]);
    }
    public function update(PostRequest $request,  $postId) {
        $data = request()->all();
        // dd($x->all(),$postId);
        Post::find($postId)->update(['title'=>$data['title'],'description' =>$data['description'],'slug' => str::slug($data['title'])]);
        return redirect()->route('posts.index');
    }
    public function destroy($postId) {
     
        // dd($postId);
        Post::find($postId)->delete();
        return redirect()->route('posts.index');
    }
}
