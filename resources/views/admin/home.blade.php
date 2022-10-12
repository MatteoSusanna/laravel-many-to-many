@extends('layouts.app')

@section('title', 'Home Amministratore')

@section('content')
    <div class="container">
        <h1>Benvenuto {{Auth::user()->name}}</h1>
    </div>
@endsection