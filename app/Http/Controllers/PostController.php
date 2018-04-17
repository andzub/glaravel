<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

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
            'title' => 'required',
            'body' => 'required',
        ]);
        
        // Get user id
        $results = User::where('name', session('name'))->get();
        foreach($results as $result) {
            $user_id = $result['id'];
        }
        
        // Create new ad
        $data = Post::create([
            'title' => request('title'),
            'body' => request('body'),
            'author_id' => $user_id,
        ]);

        return redirect('/'.$data['id']);
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
            'title' => 'required',
            'body' => 'required',
        ]);

        $post->update(request(['title', 'body', 'author_id']));

        return redirect('/');
    }

    /**
     * Delete ad
     */
    public function destroy(Post $post)
    {
        $post->delete();
        
        return redirect('/');
    }
}
