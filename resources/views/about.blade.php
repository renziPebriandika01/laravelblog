
@extends('layouts.main')

@section('container')
<div class="text-center">
    <h1>Halaman About</h1>
    <h3>{{ $name }}</h3>
    <p>{{ $email }}</p>
</div>
 
@endsection