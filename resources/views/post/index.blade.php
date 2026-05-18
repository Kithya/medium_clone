@php
    $activeCategory = request()->route('category');
    $isMyPosts = request()->routeIs('myPosts');
    $title = $isMyPosts ? 'Your stories' : ($activeCategory ? $activeCategory->name : 'Stories for you');
    $subtitle = $isMyPosts
        ? 'Draft your next idea, revisit recent posts, and keep your writing moving.'
        : 'A clean feed of recent writing from the community.';
@endphp

<x-app-layout>
    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <section class="min-w-0">
            <div class="border-b border-neutral-200 pb-6">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <h1 class="text-4xl font-semibold tracking-normal text-neutral-950">{{ $title }}</h1>
                        <p class="mt-3 max-w-2xl text-base leading-7 text-neutral-600">{{ $subtitle }}</p>
                    </div>

                    @auth
                        <x-primary-button :href="route('post.create')" class="self-start sm:self-auto">Write</x-primary-button>
                    @endauth
                </div>
            </div>

            <x-category-tabs />

            <div>
                @forelse ($posts as $post)
                    <x-post-item :post="$post" />
                @empty
                    <div class="py-16 text-center">
                        <h2 class="text-xl font-semibold text-neutral-950">No stories yet.</h2>
                        <p class="mt-2 text-sm text-neutral-600">Be the first to publish something worth reading here.</p>
                        @auth
                            <x-primary-button :href="route('post.create')" class="mt-6">Write a story</x-primary-button>
                        @else
                            <x-primary-button :href="route('login')" class="mt-6">Sign in to write</x-primary-button>
                        @endauth
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        </section>
    </div>
</x-app-layout>
