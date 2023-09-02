@extends('dashboard.layouts.main')

@section('container')
    <div class="text-center text-lg font font-medium text-red-500 mb-7">
        tambah category
    </div>
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
    <form action="/dashboard/addCategory" method="POST" >
        @method('post')
        @csrf
        <div class="mb-6">
            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Category</label>
            <input type="text" id="category" name="name"
                class=" text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500 "
                value="{{ old('category') }}" required autofocus>
            @error('category')
                <div class="text-red-500 font-medium">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-6">
            <label for="slug" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Slug</label>
            <input type="text" id="slug" name="slug"
                class=" text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500 "
                value="{{ old('slug') }}" required autofocus>
            @error('slug')
                <div class="text-red-500 font-medium">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit"
            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">Tambahkan</button>
        </div>

    </form>
@endsection
