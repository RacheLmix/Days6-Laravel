<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    
                    @if(auth()->user()->unreadNotifications->count())
                        <div class="mt-4 bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4">
                            <p class="font-bold">Thông báo mới</p>
                            <ul class="mt-2">
                                @foreach(auth()->user()->unreadNotifications as $notification)
                                    <li>{{ $notification->data['message'] ?? 'Có thông báo mới' }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
