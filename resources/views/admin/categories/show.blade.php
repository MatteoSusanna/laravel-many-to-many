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

        <table class="table table-dark table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Slug</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($category->post as $post)
                        <tr>
                            <th scope="row">{{$post->id}}</th>
                            <td>{{$post->name}}</td>
                            <td>{{$post->slug}}</td>
                        </tr>
                    @endforeach
            </tbody>

        </table>
    </div>
@endsection