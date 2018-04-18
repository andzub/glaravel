<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Select all ads
     */
    public function index()
    {
        $posts = Post::with('author')->paginate(5);
        return view('index', compact('posts'));
    }

    /**
     * Show one ad
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Redirect to page create
     */
    public function create() 
    {
        return view('posts.create');
    }

    /**
     * Creat new ad
     */
    public function store()
    {
        // Check input data
        $this->validate(request(), [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        // Get user id
//        $results = User::where('name', session('name'))->get();
//        foreach($results as $result) {
//            $author_id = $result['id'];
//        }
//
        // Create new ad
        $post = Post::create([
            'title' => request('title'),
            'body' => request('body'),
            'author_id' => Auth::user()->id,
        ]);

        return redirect('/'.$post['id']);
    }

    /**
     * Redirect to page edit
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update ad
     */
    public function update(Post $post)
    {   
        // Check input data
        $this->validate(request(), [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        // Get user id
//        $results = User::where('name', session('name'))->get();
//        foreach($results as $result) {
//            $author_id = $result['id'];
//        }

        // Check rights of user
        if (Auth::user()->id == $post->author_id) {
            $post->update(request(['title', 'body']));
        } else {
            return '<h2 style="color:red; text-align:center;">У вас нет достаточных прав!</h2>';
        }

        return redirect('/'.$post['id']);
    }

    /**
     * Delete ad
     */
    public function destroy(Post $post)
    {
        // Get user id
//        $results = User::where('name', session('name'))->get();
//        foreach($results as $result) {
//            $author_id = $result['id'];
//        }

        // Check rights of user
        if (Auth::user()->id == $post->author_id) {
            $post->delete();
        } else {
            return '<h2 style="color:red; text-align:center;">У вас нет достаточных прав!</h2>';
        }

        return redirect('/');
    }
}
