<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->get();
        return view('admin.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate( [
                                'name' => 'required|min:3|max:255',
                                'content' => 'required|min:3|max:65000',
                                'category_id' => 'nullable|exists:categories,id'
                            ]
        );

        $dati = $request->all();

        $posts = new Post();
        $posts->fill($dati);

        $posts->save();

        //creazione slug unique
        $slug = Str::slug($posts->name . '-' . $posts->id, '-'); 
        $posts->slug = $slug;

        $posts->save();
        
        return redirect()->route('admin.posts.index')->with('status', 'Post creato con succeso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        
        return view('admin.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate( [
                                'name' => 'required|min:3|max:255',
                                'content' => 'required|min:3|max:65000',
                                'category_id' => 'nullable|exists:categories,id'
                            ]
        );
        $dati = $request->all();

        //creazione slug unique
        $slug = Str::slug($dati['name'] . '-' . $post['id'], '-'); 
        $dati['slug'] = $slug;
        
        $post->update($dati);
        $post->save();

        return redirect()->route('admin.posts.edit', ['post', 'post'=> $post->id])->with('status', 'Post modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('status', 'Cancellazione avvenuta con succeso');
    }
}
