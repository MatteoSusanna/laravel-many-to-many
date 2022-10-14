<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Tag;
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
        $tags = Tag::all();
        return view('admin.create', compact('categories', 'tags'));
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
                                'category_id' => 'nullable|exists:categories,id',
                                'tags' => 'exists:tags,id',
                                'image' => 'nullable|image|max:9000',
                            ]
        );

        $dati = $request->all();

        //carica immagine
        $img_path = Storage::put('cover', $dati['image']);
        $dati['cover'] = $img_path;

        $posts = new Post();
        $posts->fill($dati);

        $posts->save();

        //creazione slug unique
        $slug = Str::slug($posts->name . '-' . $posts->id, '-'); 
        $posts->slug = $slug;

        $posts->save();
        

        if(array_key_exists('tags', $dati)){
            $posts->tags()->sync($dati['tags']);
        }

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
        $tags = Tag::all();
        return view('admin.edit', compact('post', 'categories', 'tags'));
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
                                'category_id' => 'nullable|exists:categories,id',
                                'tags' => 'exists:tags,id',
                                'image' => 'nullable|image|max:9000',
                            ]
        );
        $dati = $request->all();

        //aggiornamento immagine
        if(array_key_exists('image', $dati)){
            
            if($post->cover){
                Storage::delete($post->cover);
            }

            $img_path = Storage::put('cover', $dati['image']);
            $dati['cover'] = $img_path;
        }

        //creazione slug unique
        $slug = Str::slug($dati['name'] . '-' . $post['id'], '-'); 
        $dati['slug'] = $slug;
        
        $post->update($dati);
        $post->save();

        if(array_key_exists('tags', $dati)){
            $post->tags()->sync($dati['tags']);
        }else{
            $post->tags()->sync([]);
        }

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
        Storage::delete($post->cover);
        $post->tags()->sync([]);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('status', 'Cancellazione avvenuta con succeso');
    }
}