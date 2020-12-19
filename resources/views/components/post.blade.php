@props(['post' => $post])

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