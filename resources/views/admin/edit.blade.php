@extends('layouts.app')

@section('title', 'Modifica post')


@section('content')
<div class="container">
    <form action="{{route('admin.posts.update', ['post' => $post->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card" style="width: 18rem;">
            @if ($post->cover)
                <img src="{{asset('storage/' . $post->cover)}}">
            @else
                <h6>immagine non è presente</h6>
            @endif
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Immagine</label>
            <input type="file" id="image" name="image" class="form-control-file @error('image')is-invalid @enderror">

            @error('image')
                  <div class="invalid-feedback">{{$message}}</div>
              @enderror
        </div>

        
        <div class="mb-3">
            <label for="name" class="form-label">Category</label>

            <select name="category_id" id="category_id" class="form-control @error('name')is-invalid @enderror" >
                <option value="">No Categoria</option>
                @foreach ($categories as $category)
                    <option category_id {{(old('category_id', $post->category_id)==$category->id)?'selected':''}} value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
          
              @error('category_id')
                  <div class="invalid-feedback">{{$message}}</div>
              @enderror
        </div>

        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control @error('name')is-invalid @enderror" id="name" name="name" value="{{old('name', $post->name)}}">
        
            @error('name')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Contenuto</label>
            <textarea class="form-control @error('content')is-invalid @enderror" name="content" id="content" cols="50" rows="7" name="content">{{old('content', $post->content)}}</textarea>
        
            @error('content')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>


        <div class="d-flex">
            @foreach ($tags as $tag)
                @if ($errors->any())
                    <div class="form-group form-check mr-4">
                        <input {{(in_array($tag->id, old('tags', [])))? 'checked': ''}} type="checkbox" class="form-check-input" id="tag_{{$tag->id}}" name="tags[]" value="{{$tag->id}}">
                        <label class="form-check-label" for="tag_{{$tag->id}}"><strong>+ {{$tag->name}}</strong></label>
                    </div>
                @else
                    <div class="form-group form-check mr-4">
                        <input {{($post->tags->contains($tag))? 'checked': ''}} type="checkbox" class="form-check-input" id="tag_{{$tag->id}}" name="tags[]" value="{{$tag->id}}">
                        <label class="form-check-label" for="tag_{{$tag->id}}"><strong>+ {{$tag->name}}</strong></label>
                    </div>
                @endif
            @endforeach

            @error('content')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    
        <button type="submit" class="btn btn-primary">Applica</button>
        <a href="{{route('admin.posts.index')}}" class="btn btn-primary">Indietro</a>
    </form>
</div>
@endsection