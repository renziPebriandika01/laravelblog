@extends('layouts.main')

@section('container')
<div class="container mb-5">
    <div class="mb-10">
        <form action="/posts">
            <div class="flex justify-center">
                <div class="relative w-2/4">
                    <input type="search" id="search-dropdown" name="search"
                        class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border rounded-md border-l-lg  border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500 border-l-2" 
                        placeholder="search...." value="{{request('search')}}" required>
                    <button type="submit"
                        class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </div>
            </div>
        </form>
    </div>


    @if ($posts->count(1))
    <div class="flex justify-center mb-5">
        <div class="max-w-xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 relative">
            <a href="/posts/{{ $posts[0]->slug }}">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    {{ $posts[0]->title }}
                </h5>
            </a>
                <small>penulis: {{ $posts[0]->author }}</small>
                <div class="absolute top-0 right-0 bg-black bg-opacity-50 text-white px-2 py-1 rounded-tr-lg">
                    {{ $posts[0]->category->name }}
                </div>
           
            <div class="flex justify-center">
                <img src="{{ asset('storage/' . $posts[0]->image) }}" alt="" class="w-32 h-40 max-h-30 overflow-hidden">
            </div>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $posts[0]->excerpt }}</p>
            <a href="/posts/{{ $posts[0]->slug }}"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Read more
                <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div>
    </div>
    


    <div class="mx-auto my-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 ml-2 md:px-0 gap-3 ">
            @foreach ($posts as $post)
            <div class="max-w-xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 relative">
                <a href="/posts/{{ $post->slug }}">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {{ $post->title }}
                    </h5>
                </a>
                    <small>penulis: {{ $post->author }}</small>
                    <div class="absolute top-0 right-0 bg-black bg-opacity-50 text-white px-2 py-1 rounded-tr-lg">
                        {{ $post->category->name }}
                    </div>
               
                <div class="flex justify-center">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="" class="w-32 h-40 max-h-30 overflow-hidden">
                </div>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $post->excerpt }}</p>
                <a href="/posts/{{ $post->slug }}"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Read more
                    <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>
            
            @endforeach
        </div>
    </div>

        
    @else
    <p class="text-center text-2xl font-semibold mt-10">Not Found :V</p>        
    @endif
</div>
@endsection
