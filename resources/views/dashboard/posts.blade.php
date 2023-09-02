@extends('dashboard.layouts.main')

@section('container')
    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 w-1/2"
            role="alert">
            {{ session('success') }}
        </div>
    @endif


    @if ($errors->any())
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <a href="/dashboard/posts/create"
        class=" w-[130px] flex text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
        <svg class="w-[20px] h-[20px] text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 18 18">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 1v16M1 9h16" />
        </svg>
        <span class="ml-3">tambah</span>
    </a>
    <div class="w-full my-10">
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        @role('admin')
                            <th scope="col" class="px-6 py-3 align-middle">
                                Pembuat
                            </th>
                        @endrole
                        <th scope="col" class="px-6 py-3 align-middle">
                            Judul
                        </th>
                        <th scope="col" class="px-6 py-3 align-middle">
                            Penulis
                        </th>
                        <th scope="col" class="px-6 py-3 align-middle">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3 align-middle">
                            Gambar
                        </th>
                        <th scope="col" class="px-6 py-3 align-middle">
                            Waktu dibuat
                        </th>
                        <th scope="col" class="px-6 py-3 text-center align-middle">
                            Aksi
                        </th>
                    </tr>
                </thead>
                {{-- admin --}}
                @role('admin')
                    <tbody>
                        @foreach ($postsAdmin as $post)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <td class="px-6 py-4 align-middle">
                                    {{ $post->user->name }}
                                </td>
                                <td class="px-6 py-4align-middle">
                                    {{ strlen($post->title) > 20 ? substr($post->title, 0, 20) . '....' : $post->title }}
                                </td>
                                <td class="px-6  align-middle">
                                    {{ $post->author }}
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    {{ $post->category->name }}
                                </td>
                                <td class="px-6 py-4 align-middle ">
                                    <img src="{{ asset('storage/' . $post->image) }}" alt=""
                                        class="w-10 h-9 max-h-20 overflow-hidden">

                                </td>
                                <td class="px-6 py-4 align-middle">
                                    {{ $post->created_at }}
                                </td>
                                <td class="px-6 py-4 text-center align-middle">
                                    <div class="flex space-x-4">
                                        <div class="text-center align-middle">
                                            <a href="/dashboard/posts/{{ $post->id }}" class="">
                                                <svg class="w-[17px] h-[17px] text-blue-800 dark:text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 14">
                                                    <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2">
                                                        <path d="M10 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                                        <path
                                                            d="M10 13c4.97 0 9-2.686 9-6s-4.03-6-9-6-9 2.686-9 6 4.03 6 9 6Z" />
                                                    </g>
                                                </svg>
                                            </a>
                                        </div>

                                        <div class=" text-center align-middle">
                                            <a href="/dashboard/posts/{{ $post->id }}/edit" class="">
                                                <svg class="w-[15px] h-[15px] text-green-400 dark:text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M7.418 17.861 1 20l2.139-6.418m4.279 4.279 10.7-10.7a3.027 3.027 0 0 0-2.14-5.165c-.802 0-1.571.319-2.139.886l-10.7 10.7m4.279 4.279-4.279-4.279m2.139 2.14 7.844-7.844m-1.426-2.853 4.279 4.279" />
                                                </svg>
                                            </a>
                                        </div>

                                        <div class=" text-center align-middle">
                                            {{-- pop-up delete --}}
                                            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal">
                                                <svg class="w-[14px] h-[14px] text-red-700 dark:text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor"
                                                        d="M12.186 8.672 18.743.947h-2.927l-5.005 5.9-4.44-5.9H0l7.434 9.876-6.986 8.23h2.927l-5.434-6.4 4.82 6.4H20L12.186 8.672Zm-2.267 2.671L8.544 9.515 3.2 2.42h2.2l4.312 5.719 1.375 1.828 5.731 7.613h-2.2l-4.699-6.237Z" />
                                                </svg>
                                            </button>

                                            <div id="popup-modal" tabindex="-1"
                                                class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative w-full max-w-md max-h-full">
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <button type="button"
                                                            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                            data-modal-hide="popup-modal">
                                                            <svg class="w-3 h-3" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                        <div class="p-6 text-center">
                                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                fill="none" viewBox="0 0 20 20">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                            </svg>
                                                            <h3
                                                                class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                               Are You Sure Delete This Post</h3>
                                                            <form action="/dashboard/posts/{{ $post->id }} "
                                                                method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit"
                                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2 mb-2">
                                                                    Yes
                                                                </button>
                                                            </form>
                                                            <button data-modal-hide="popup-modal" type="button"
                                                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                                                                cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                @endrole
                @role('penulis')
                    <tbody>
                        @foreach ($posts as $post)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <td class="px-6 py-4 align-middle">
                                    {{ strlen($post->title) > 20 ? substr($post->title, 0, 20) . '....' : $post->title }}
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    {{ $post->author }}
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    {{ $post->category->name }}
                                </td>
                                <td class="px-6 py-4 align-middle w-8">
                                    <img src="{{ asset('storage/' . $post->image) }}" alt=""
                                        class="w-10 h-9 max-h-20 overflow-hidden">
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    {{ $post->created_at }}
                                </td>
                                <td class="px-6 py-4 text-center align-middle">
                                    <div class="flex space-x-4">
                                        <div class="text-center align-middle">
                                            <a href="/dashboard/posts/{{ $post->id }}" class="">
                                                <svg class="w-[17px] h-[17px] text-blue-800 dark:text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 14">
                                                    <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2">
                                                        <path d="M10 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                                        <path
                                                            d="M10 13c4.97 0 9-2.686 9-6s-4.03-6-9-6-9 2.686-9 6 4.03 6 9 6Z" />
                                                    </g>
                                                </svg>
                                            </a>
                                        </div>

                                        <div class=" text-center align-middle">
                                            <a href="/dashboard/posts/{{ $post->id }}/edit" class="">
                                                <svg class="w-[15px] h-[15px] text-green-400 dark:text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M7.418 17.861 1 20l2.139-6.418m4.279 4.279 10.7-10.7a3.027 3.027 0 0 0-2.14-5.165c-.802 0-1.571.319-2.139.886l-10.7 10.7m4.279 4.279-4.279-4.279m2.139 2.14 7.844-7.844m-1.426-2.853 4.279 4.279" />
                                                </svg>
                                            </a>
                                        </div>

                                        <div class=" text-center align-middle">
                                            {{-- pop-up delete --}}
                                            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal">
                                                <svg class="w-[14px] h-[14px] text-red-700 dark:text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor"
                                                        d="M12.186 8.672 18.743.947h-2.927l-5.005 5.9-4.44-5.9H0l7.434 9.876-6.986 8.23h2.927l-5.434-6.4 4.82 6.4H20L12.186 8.672Zm-2.267 2.671L8.544 9.515 3.2 2.42h2.2l4.312 5.719 1.375 1.828 5.731 7.613h-2.2l-4.699-6.237Z" />
                                                </svg>
                                            </button>

                                            <div id="popup-modal" tabindex="-1"
                                                class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative w-full max-w-md max-h-full">
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <button type="button"
                                                            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                            data-modal-hide="popup-modal">
                                                            <svg class="w-3 h-3" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                        <div class="p-6 text-center">
                                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                fill="none" viewBox="0 0 20 20">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                            </svg>
                                                            <h3
                                                                class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                              Lu Yakin Hapus Postingan Ini ?</h3>
                                                            <form action="/dashboard/posts/{{ $post->id }} "
                                                                method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit"
                                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2 mb-2">
                                                                  Ya 
                                                                </button>
                                                            </form>
                                                            <button data-modal-hide="popup-modal" type="button"
                                                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                             Engga Bro</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                @endrole

            </table>
        </div>



    @endsection
