<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-5">
                <div class="p-6 d-flex justify-content-between align-items-center border-bottom border-muted">
                    <h1>Posts</h1>
                    <a href="{{route("post.modal")}}" class="btn btn-sm btn-primary">Create Post</a>
                </div>
                <div class="p-6">
                    @include('posts.listing', ['posts' => $posts])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


