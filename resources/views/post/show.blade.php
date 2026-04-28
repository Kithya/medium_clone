<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">

                <h1 class="mb-4 text-3xl text-bold">{{ $post->title }}</h1>

                <div class="flex gap-4 items-center">
                    <x-user-avatar :user="$post->user" />

                    <div>
                        <x-follow-container :user="$post->user" class="flex gap-2">
                            <a href="{{ route('profile.show', $post->user) }}"
                                class="hover:underline">{{ $post->user->name }}</a>
                            @auth
                                &middot;
                                <button class="text-purple-500 hover:underline" x-text="following ? 'Unfollow' : 'Follow' "
                                    @click="follow()"></button>
                            @endauth
                        </x-follow-container>
                        <div class="flex gap-2 text-sm">
                            <span class="text-gray-500">
                                {{ $post->readTime() }} min read
                            </span>
                            &middot;
                            <span class="text-gray-500">
                                {{ $post->created_at->format('M d, Y') }}
                            </span>
                        </div>
                    </div>


                </div>
                {{-- Clap Section --}}
                <x-clap-button :post="$post" />

                <div class="mt-6">
                    @if ($post->imageUrl('large'))
                        <img src="{{ $post->imageUrl('large') }}" alt="{{ $post->title }}" class="w-full">
                    @endif

                    <div class="mt-4">
                        {{ $post->content }}
                    </div>
                </div>

                <div class="mt-8">
                    <span class="px-6 py-3 bg-gray-200 rounded-full">
                        {{ $post->category->name }}
                    </span>
                </div>

                <x-clap-button :post="$post" />
            </div>
        </div>
    </div>
</x-app-layout>
