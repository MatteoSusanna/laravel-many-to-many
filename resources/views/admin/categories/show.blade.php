@extends('layouts.app')

@section('title', 'Dettaglio post')

@section('content')
    <div class="container">
        <div class="card text-bg-info mb-3" style="max-width: 18rem;">
            <div class="card-header"><strong>Name: {{$category->name}}</strong></div>
            <div class="card-body">
              <h6 class="card-title">Slug: {{$category->slug}}</h6>
            </div>
        </div>
        <a href="{{route('admin.categories.index')}}" class="btn btn-primary">Indietro</a>
    </div>
    <div class="container">

        @if (count($category->post)) 
            <table class="table table-dark table-striped my-3">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Slug</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($category->post as $post)
                            <tr>
                                <th scope="row">{{$post->id}}</th>
                                <td>
                                    <div class="card" style="width: 5rem;">
                                        @if ($post->cover)
                                            <img src="{{asset('storage/' . $post->cover)}}">
                                        @else
                                            <h6>immagine non è presente</h6>
                                        @endif
                                    </div>
                                </td>
                                <td>{{$post->name}}</td>
                                <td>{{$post->slug}}</td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
        @else
            <table class="table table-dark table-striped my-3">
                <thead>
                    <tr>
                        <th scope="col">NESSUN POST ASSOCIATO</th>
                    </tr>
                </thead>
            </table>
        @endif
    </div>
@endsection