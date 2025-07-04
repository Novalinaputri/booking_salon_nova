@extends('layouts.app')
@section('content')
    <h1>Selamat datang, {{ auth()->user()->name }}!</h1>
@endsection