<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chỉnh sửa bài viết') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <a href="{{ route('admin.posts.index') }}" class="text-blue-500 hover:underline">
                            &larr; Quay lại danh sách bài viết
                        </a>
                    </div>

                    <form method="POST" action="{{ route('admin.posts.update', $post) }}">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Tiêu đề')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $post->title)" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Content -->
                        <div class="mb-4">
                            <x-input-label for="content" :value="__('Nội dung')" />
                            <textarea id="content" name="content" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="10" required>{{ old('content', $post->content) }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <!-- Author Info (Read-only) -->
                        <div class="mb-4">
                            <x-input-label :value="__('Thông tin tác giả')" />
                            <div class="mt-1 p-3 bg-gray-50 rounded-md">
                                <p><strong>Tên:</strong> {{ $post->user->name }}</p>
                                <p><strong>Email:</strong> {{ $post->user->email }}</p>
                                <p><strong>Ngày tạo:</strong> {{ $post->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Cập nhật bài viết') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>