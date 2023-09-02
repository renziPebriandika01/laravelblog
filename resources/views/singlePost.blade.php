@extends('layouts/main')

@section('container')
    <div class="container mx-auto">
        <div class="flex justify-center mb-5">
            <div class="w-8/12">
                <h1 class="text-3xl font-bold mb-3">{{ $post->title }}</h1>

                <p>By. {{ $post->author }} </p>
                <small class="text-white absolute top-20 right-20 bg-black bg-opacity-50 px-2 py-1 rounded-sm">category : {{ $post->category->name }}</small>

                <img src="{{ asset('storage/' .$post->image) }}" alt="{{ $post->category }}"
                    class="w-32 h-40 max-h-30 overflow-hidde">

                <article class="my-3 text-lg">
                    {!! $post->body !!}
                </article>

                <a href="/posts" class="block mt-3 text-blue-500 hover:underline">back to blogg</a>
            </div>
        </div>
    </div>
@endsection
