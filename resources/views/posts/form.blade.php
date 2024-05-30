<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight">
            {{$title}}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-5">
        <form method="post" name="post-form" id="post-form" action="{{route("post.store", ['id' => @$post->id])}}">
            @csrf

                <div class="field">
                    <label for="post" class="form-label">
                        <span class="required">Text</span>
                    </label>

                    <input type="text" class="form-control" id="post" name="post" value="{{@$post->text}}"
                           placeholder="Please write post" required>
                </div>


                <div class="col-lg-12 text-end mt-3">
                    <x-primary-button class="ms-3">
                        {{ __('Save') }}
                    </x-primary-button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
