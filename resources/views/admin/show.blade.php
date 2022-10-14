@extends('layouts.app')

@section('title', 'Dettaglio post')

@section('content')
    <div class="container">
        <div class="card" style="width: 18rem;">
            @if ($post->cover)
                <img src="{{asset('storage/' . $post->cover)}}">
            @else
                <h6>immagine non è presente</h6>
            @endif
            
            <div class="card-body">
              <h5 class="card-title">Name: {{$post->name}}</h5>
              <p class="card-text">Content: {{$post->content}}</p>
              <h5 class="card-title">Slug: {{$post->slug}}</h5>

                <strong>TAG:</strong>
                    @foreach ($post->tags as $tag)
                        <strong> {{$tag->name}} -</strong>
                    @endforeach
            </div>
        </div>
        <a href="{{route('admin.posts.index')}}" class="btn btn-primary my-3">Indietro</a>
    </div>
@endsection