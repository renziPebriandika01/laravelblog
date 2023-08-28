@extends('dashboard.layouts.main')
@section('container')
    <div class="container mx-auto">
        <div class="flex justify-center mb-5">
            <div class="w-8/12">
                <h1 class="text-3xl font-bold mb-3">{{ $post->title }}</h1>

                <p>By. {{ $post->author }} </p>
                <p class="text-red-500 uppercase">{{ $post->category->name }}</p>

                <img src="https://source.unsplash.com/1200x400?{{ $post->category }}" alt="{{ $post->category }}"
                    class="w-full h-auto my-3">

                <article class="my-3 text-lg">
                    {!! $post->body !!}
                </article>

                {{-- <a href="/posts" class="block mt-3 text-blue-500 hover:underline">back to blogg</a> --}}
            </div>
        </div>
    </div>
@endsection
