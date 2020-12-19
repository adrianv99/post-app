@extends('layouts.app')

@section('content')
    <div class="flex justify-center flex-wrap">
        <div class="w-8/12 bg-white p-6 rounded-lg my-10">
            <h1 class="text-xl text-gray-800 font-bold mt-5 mb-8">
                {{ $user->name }}
            </h1>
            <h3 class="text-gray-700 font-semibold my-2">
               Since: <span class="text-indigo-600"> {{ $user->created_at->diffForHumans() }} </span>
            </h3>
            <h3 class="text-gray-700 font-semibold my-2">
               Total posts: <span class="text-indigo-600"> {{ $user->posts->count() }} {{ Str::plural('post', $user->posts->count())}}</span>
            </h3>
            <h3 class="text-gray-700 font-semibold my-2">
                Total likes: <span class="text-indigo-600"> {{ $user->receivedLikes()->count() }} {{ Str::plural('like', $user->posts->count())}}</span>
            </h3>
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
            <p class="my-5 text-xl w-8/12">{{ $user->name }} have no posts for now :( </p>
        @endif

    </div>
@endsection