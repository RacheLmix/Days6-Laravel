<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="mb-6">
                        <a href="{{ route('user.posts.index') }}" class="text-blue-500 hover:underline">
                            &larr; Back to Posts
                        </a>
                    </div>

                    <div class="mb-6">
                        <h1 class="text-2xl font-bold mb-2">{{ $post->title }}</h1>
                        <div class="text-sm text-gray-600 mb-4">
                            By {{ $post->user->name }} | {{ $post->created_at->format('d/m/Y H:i') }}
                        </div>
                        <div class="prose max-w-none">
                            {{ $post->content }}
                        </div>
                    </div>

                    @can('update', $post)
                        <div class="flex space-x-4 mt-6">
                            <a href="{{ route('user.posts.edit', $post) }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Edit Post
                            </a>
                            
                            <form method="POST" action="{{ route('user.posts.destroy', $post) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600" onclick="return confirm('Are you sure you want to delete this post?')">
                                    Delete Post
                                </button>
                            </form>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>