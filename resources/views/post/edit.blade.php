<x-app-layout>
    <div class="mx-auto max-w-3xl px-4 py-10 sm:px-6 lg:px-8">
        <header class="border-b border-neutral-200 pb-6">
            <h1 class="text-4xl font-semibold tracking-normal text-neutral-950">Edit story</h1>
            <p class="mt-3 text-base leading-7 text-neutral-600">Polish the title, image, topic, or body before readers see the update.</p>
        </header>

        <form action="{{ route('post.update', $post) }}" enctype="multipart/form-data" method="POST" class="mt-8 space-y-6">
            @csrf
            @method('put')

            @if ($post->imageUrl())
                <div>
                    <x-input-label :value="__('Current cover')" />
                    <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" class="mt-2 aspect-video w-full rounded-md object-cover">
                </div>
            @endif

            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" class="mt-2 block w-full text-lg" type="text" name="title" :value="old('title', $post->title)" required autofocus />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="category_id" :value="__('Topic')" />
                <select id="category_id" name="category_id" class="mt-2 w-full rounded-md border-neutral-300 text-neutral-950 shadow-sm focus:border-neutral-950 focus:ring-neutral-950" required>
                    <option value="">Select a topic</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="image" :value="__('Replace cover image')" />
                <x-text-input id="image" class="mt-2 block w-full" type="file" name="image" accept="image/*" />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="content" :value="__('Story')" />
                <x-input-textarea id="content" class="mt-2 block w-full text-lg leading-8" name="content" required>{{ old('content', $post->content) }}</x-input-textarea>
                <x-input-error :messages="$errors->get('content')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-neutral-200 pt-6">
                <x-secondary-button onclick="window.location='{{ route('post.show', ['username' => $post->user->username, 'post' => $post->slug]) }}'">
                    Cancel
                </x-secondary-button>
                <x-primary-button>
                    Save changes
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
