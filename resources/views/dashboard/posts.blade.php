@extends('dashboard.layouts.main')

@section('container')
<a href="/dashboard/posts/create"
class="text-white bg-gradient-to-r ml-28 from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 
focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-10">tambah
postingan</a>

    <div class="max-w-3xl mx-auto my-10">
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 align-middle">
                          Title
                        </th>
                        <th scope="col" class="px-6 py-3 align-middle">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3 align-middle">
                            Waktu dibuat
                        </th>
                        <th scope="col" class="px-6 py-3 text-center align-middle">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white align-middle">
                                {{ $post->title }}
                            </th>
                            <td class="px-6 py-4 align-middle">
                                {{ $post->category->name }}
                            </td>
                            <td class="px-6 py-4 align-middle">
                                {{ $post->created_at }}
                            </td>
                            <td class="px-6 py-4 text-center align-middle">
                                <a href="/dashboard/posts/{{ $post->id }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 px-1 hover:underline">show</a>

                                <a href="#"
                                    class="font-medium text-red-600 dark:text-red-500 px-1 hover:underline">Edit</a>

                                <a href="/dashboard/posts"
                                    class="font-medium text-yellow-300 px-1 dark:text-yellow-500 hover:underline">delete</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
