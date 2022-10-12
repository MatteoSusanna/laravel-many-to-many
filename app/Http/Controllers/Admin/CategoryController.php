<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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
                            ]
        );

        $dati = $request->all();

        $category = new Category();
        $category->fill($dati);

        $slug = Str::slug($category->name . '-' . $category->id, '-'); 
        $category->slug = $slug;

        $category->save();

        //creazione slug unique
        $slug = Str::slug($category->name . '-' . $category->id, '-'); 
        $category->slug = $slug;

        $category->save();
        
        return redirect()->route('admin.categories.index')->with('status', 'Categoria creata con succeso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate( [
                                'name' => 'required|min:3|max:255',
                            ]
        );
        $dati = $request->all();

        //creazione slug unique
        $slug = Str::slug($dati['name'] . '-' . $category['id'], '-'); 
        $dati['slug'] = $slug;
        
        $category->update($dati);
        $category->save();

        return redirect()->route('admin.categories.edit', ['category', 'category'=> $category->id])->with('status', 'Post modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index');
    }
}
