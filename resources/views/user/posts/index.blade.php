<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bài viết') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between mb-6">
                        <h3 class="text-lg font-semibold">Danh sách bài viết</h3>
                        <a href="{{ route('user.posts.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Tạo bài viết mới</a>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tiêu đề</th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tác giả</th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Ngày tạo</th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posts as $post)
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-200">{{ $post->title }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200">{{ $post->user->name }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200">{{ $post->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            <a href="{{ route('user.posts.show', $post) }}" class="text-blue-500 hover:underline mr-2">Xem</a>
                                            @can('update', $post)
                                                <a href="{{ route('user.posts.edit', $post) }}" class="text-yellow-500 hover:underline mr-2">Sửa</a>
                                            @endcan
                                            @can('delete', $post)
                                                <form action="{{ route('user.posts.destroy', $post) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">Xóa</button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-2 px-4 border-b border-gray-200 text-center">Không có bài viết nào.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>