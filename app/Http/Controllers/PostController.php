<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $allPosts = [
            ['id' => 1, 'header' => 'Post Info', 'title' => 'Special title treatment','Description'=>'With supporting text below as a nautral lead in to additional content', 'posted_by' => 'Ahmed', 'creation_date' => '2022-10-22'],
            ['id' => 2, 'header' => 'Post Info', 'title' => 'Special title treatment', 'Description'=>'With supporting text below as a nautral lead in to additional content','posted_by' => 'Mohamed', 'creation_date' => '2022-10-15'],
        ];

        return view('posts.index', [
            'posts' => $allPosts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function show($postId)
    {
        $arr = [
            ['id' => 1, 'header' => 'Post Info', 'title' => 'Special title treatment', 'Description'=>'With supporting text below as a nautral lead in to additional content', 'posted_by' => 'Ahmed', 'creation_date' => '2022-10-22'],
            ['id' => 2, 'header' => 'Post Info', 'title' => 'Special title treatment', 'Description'=>'With supporting text below as a nautral lead in to additional content','posted_by' => 'Mohamed', 'creation_date' => '2022-10-15'],
        ];
        // dd($arr);
        return view('posts.show', [
            'post' => $arr[$postId - 1]
        ]);
    }

    public function store()
    {
        return redirect()->route('posts.index');
    }
}
