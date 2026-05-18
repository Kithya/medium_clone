<x-app-layout>
    <div class="mx-auto max-w-3xl px-4 py-10 sm:px-6 lg:px-8">
        <header class="border-b border-neutral-200 pb-6">
            <h1 class="text-4xl font-semibold tracking-normal text-neutral-950">Write a story</h1>
            <p class="mt-3 text-base leading-7 text-neutral-600">Give readers a strong title, a clean image, and a focused idea.</p>
        </header>

        <form action="{{ route('post.store') }}" enctype="multipart/form-data" method="POST" class="mt-8 space-y-6">
            @csrf

            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" class="mt-2 block w-full text-lg" type="text" name="title" :value="old('title')" required autofocus />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="category_id" :value="__('Topic')" />
                <select id="category_id" name="category_id" class="mt-2 w-full rounded-md border-neutral-300 text-neutral-950 shadow-sm focus:border-neutral-950 focus:ring-neutral-950" required>
                    <option value="">Select a topic</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="image" :value="__('Cover image')" />
                <x-text-input id="image" class="mt-2 block w-full" type="file" name="image" accept="image/*" required />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="content" :value="__('Story')" />
                <x-input-textarea id="content" class="mt-2 block w-full text-lg leading-8" name="content" required>{{ old('content') }}</x-input-textarea>
                <x-input-error :messages="$errors->get('content')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-neutral-200 pt-6">
                <x-secondary-button onclick="window.location='{{ route('dashboard') }}'">
                    Cancel
                </x-secondary-button>
                <x-primary-button>
                    Publish
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
