@extends('layouts.app')

@section('title', 'Dettaglio post')

@section('content')
    <div class="container">
        <div class="card text-bg-info mb-3" style="max-width: 18rem;">
            <div class="card-header">Name: {{$post->name}}</div>
            <div class="card-body">
              <h5 class="card-title">Slug: {{$post->slug}}</h5>
              <p class="card-text">Content: {{$post->content}}</p>
            </div>
        </div>
        <a href="{{route('admin.posts.index')}}" class="btn btn-primary">Indietro</a>
    </div>
@endsection