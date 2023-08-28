
@extends('dashboard.layouts.main')

@section('container')
  <h1>Welcome {{auth()->user()->name}}</h1>
@endsection