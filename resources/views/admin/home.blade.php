@extends('layouts.app')

@section('title', 'Area Amministrativa')

@section('content')

<div class="container">
    <h1>Benvenuto {{Auth::user()->name}}</h1>
</div>

@endsection