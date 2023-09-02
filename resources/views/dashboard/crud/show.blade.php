@extends('dashboard.layouts.main')
@section('container')
    <div class="container mx-auto">
        <div class="flex justify-end">
            <a href="/dashboard/posts"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">
                Back <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg></a>
        </div>
        <div class="flex justify-center mb-5">
            <div class="w-8/12">
                <h1 class="text-3xl font-bold mb-3">{{ $post->title }}</h1>
                <div class="flex space-x-4">
                    <div class="flex text-center align-middle">
                        <a href="/dashboard/posts/{{ $post->id }}/edit" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg class="w-[15px] h-[15px] text-green-400 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M7.418 17.861 1 20l2.139-6.418m4.279 4.279 10.7-10.7a3.027 3.027 0 0 0-2.140-5.165c-.802 0-1.571.319-2.139.886l-10.7 10.7m4.279 4.279-4.279-4.279m2.139 2.14 7.844-7.844m-1.426-2.853 4.279 4.279" />
                            </svg>
                            <span class="flex-1 ml-3 whitespace-nowrap">Edit</span>
                        </a>
                    </div>
                
                    <div class="flex text-center align-middle">
                        <form action="/dashboard/posts/{{ $post->id }} " method="post">
                            @method('delete')
                            @csrf
                            <button onclick="return(confirm('yakin ?'))" class="inline-flex text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group pt-3 px-3">
                                <svg class="w-[17px] h-[17px] text-red-700 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" d="M12.186 8.672 18.743.947h-2.927l-5.005 5.9-4.44-5.9H0l7.434 9.876-6.986 8.23h2.927l-5.434-6.4 4.82 6.4H20L12.186 8.672Zm-2.267 2.671L8.544 9.515 3.2 2.42h2.2l4.312 5.719 1.375 1.828 5.731 7.613h-2.2l-4.699-6.237Z"/>
                                </svg>
                                <span>Hapus</span>
                            </button>
                        </form>
                    </div>
                </div>
                

                <p class="text-blue-400">author: {{ $post->author }} </p>
                <p class="text-red-500 ">{{ $post->category->name }}</p>
                <div class="flex justify-center">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}"
                        class="w-1/2 h-36 max-h-40 overflow-hidden">
                </div>

                <article class="my-3 text-lg">
                    {!! $post->body !!}
                </article>

                {{-- <a href="/posts" class="block mt-3 text-blue-500 hover:underline">back to blogg</a> --}}
            </div>
        </div>
    </div>
@endsection
