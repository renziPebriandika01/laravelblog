@extends('dashboard.layouts.main')

@section('container')
<div class="text-center text-lg font font-medium text-blue-500 mb-7">
   Edit Postingan
</div>
    <form action="/dashboard/posts/{{$post->id}}" method="POST">
        @method('put')
        @csrf

        <div class="mb-6">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
            <input type="text" id="title" name="title"
                class=" text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('title') bg-red-50 border border-red-500 text-red-900  @enderror" value="{{old('title',$post->title)}}"  autofocus>
                @error('title')
                <div class="text-red-500 font-medium">{{$message}}</div>
                @enderror
        </div>
        <div class="mb-6">
            <label for="slug" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slug</label>
            <input type="text" id="slug" name="slug"
                class="  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('slug') bg-red-50 border border-red-500 text-red-900 @enderror"  value="{{old('slug',$post->slug)}}" autofocus>
                @error('slug')
                <div class="text-red-500 font-medium">{{$message}}</div>
                @enderror
        </div>
        <div class="mb-6">
            <label for="author" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penulis</label>
            <input type="text" id="author" name="author"
                class="  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('author') bg-red-50 border border-red-500 text-red-900 @enderror"  value="{{old('author',$post->author)}}" autofocus>
                @error('author')
                <div class="text-red-500 font-medium">{{$message}}</div>
                @enderror
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">category</label>
            <select name="category_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach ($categories as $category)
                @if(old('category_id',$post->category_id) == $category->id)
                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                @else 
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endif
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <div class="">
                <label for="Body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Body</label>
                <input id="body" type="hidden" name="body"  value="{{old('body',$post->body)}}">
                <trix-editor input="body" class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </trix-editor>
            </div>

        </div>
        
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Perbaharui</button>
        </div>
    </form>
    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', async function() {
            try {
                const response = await fetch('http://localhost:8000/dashboard/posts/checkSlug?title=' + title
                    .value);
                const jsonData = JSON.stringify('title');
                const data = await response.json();
                slug.value = data.slug;
            } catch (error) {
                console.error('Fetch error:', error);
            }
        });
    </script>
@endsection
