@extends('layouts.app')

@section('content')
    <div class="flex justify-center flex-wrap">
        <div class="w-8/12 bg-white p-6 rounded-lg my-10">
            <h1 class="text-xl text-gray-800 font-bold mt-5 mb-8">
                Posts
            </h1>
            @auth
            <form action="{{ route('posts') }}" method="post">
                @csrf
                <div class="mb-4">
                    <textarea name="body" id="body" cols="30" rows="4"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror"
                    placeholder="Post something..."></textarea>
                    @error('body')
                        <div class="text-red-500 text-sm mt-2"> {{ message }}</div>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="bg-indigo-500 px-4 py-2 text-white font-medium rounded">Post</button>
                </div>
            </form>
            @endauth
            @guest
                <p class="my-5 text-indigo-500 text-xl">Login to post something :)</p>   
            @endguest
        </div>

        @if ($posts->count())
            @foreach ($posts as $post)
                <div class="w-8/12 my-2 p-4 bg-indigo-400 text-white rounded">
                    <a href="{{ route('users.posts', $post->user) }}" class="font-semibold">{{ $post->user->name }},</a>
                    <span class="font-semibold">{{ $post->created_at->diffForHumans() }}</span>
                    <p class="my-5 text-xl">{{ $post->body }}</p>
                    <div class="flex items-center">
                        @auth
                            @if (!$post->likedBy(auth()->user()))
                            <form action="{{ route('post.likes', $post->id) }}" method="post">
                                @csrf
                                <button type="submit" class="mr-3 text-sm text-gray-200">Like</button>
                            </form>
                            @else
                            <form action="{{ route('post.likes', $post->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="mr-2 text-sm text-gray-200">Unlike</button>
                            </form>
                            @endif
                        @endauth
                        <p class="text-sm">{{ $post->likes->count() }} ❤️</p>
                        @can('delete', $post)
                            <form action="{{ route('posts.destroy', $post) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ml-3 p-2 rounded text-sm text-red-800 hover:bg-red-400 hover:text-white"
                                >Delete Post</button>
                            </form>
                        @endcan
                    </div>
                </div>
            @endforeach
            <div class="w-8/12 my-5">
                {{ $posts->links() }}
            </div>
        @else
            <p class="my-5 text-xl w-8/12">There are no posts for now :( </p>
        @endif

    </div>
@endsection