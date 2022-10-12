@extends('layouts.app')

@section('title', 'Gestione post')

@section('content')
    <div class="container">
        <a class="nav-link btn btn-success" href="{{ route('admin.categories.create') }}">Crea Categoria</a>
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
                    @foreach ($categories as $category)
                        <tr>
                            <th scope="row">{{$category->id}}</th>
                            <td>{{$category->name}}</td>
                            <td>{{$category->slug}}</td>
                            <td class="d-flex">
                                <a href="{{route('admin.categories.show', ['category' => $category->id])}}" class="btn btn-primary">Vedi</a>
                                <a {{--href="{{route('admin.posts.edit', ['post' => $post->id])}}"--}} class="btn btn-warning mx-2">Modifica</a>

                                <form {{--action="{{route('admin.posts.destroy', ['post' => $post->id])}}"--}} method="POST" onsubmit="return confirm('Vuoi cancellare definitivamente il post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">CANCELLA</button>
                                </form>
                            </td>
                            
                        </tr>
                    @endforeach
            </tbody>

        </table>
    </div>
@endsection