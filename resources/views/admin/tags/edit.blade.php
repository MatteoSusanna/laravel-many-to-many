@extends('layouts.app')

@section('title', 'Creazione categoria')


@section('content')
<div class="container">
    <form action="{{route('admin.tags.update', ['tag' => $tag->id])}}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control @error('name')is-invalid @enderror" id="name" name="name" value="{{old('name', $tag->name)}}">
        
            @error('name')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    
        <button type="submit" class="btn btn-primary">Modifica</button>
        <a href="{{route('admin.tags.index')}}" class="btn btn-primary">Indietro</a>
    </form>
</div>


@endsection