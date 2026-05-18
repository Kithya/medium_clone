<x-app-layout>
    <article class="mx-auto max-w-3xl px-4 py-10 sm:px-6 lg:px-8">
        <header>
            @if ($post->category)
                <a href="{{ route('post.byCategory', $post->category) }}" class="text-sm font-medium text-neutral-600 hover:text-neutral-950">
                    {{ $post->category->name }}
                </a>
            @endif

            <h1 class="mt-4 text-4xl font-semibold leading-tight tracking-normal text-neutral-950 sm:text-5xl">
                {{ $post->title }}
            </h1>

            <div class="mt-6 flex items-center justify-between gap-4">
                <div class="flex min-w-0 items-center gap-3">
                    <x-user-avatar :user="$post->user" size="h-11 w-11" />

                    <div class="min-w-0">
                        <x-follow-container :user="$post->user" class="flex flex-wrap items-center gap-2 text-sm">
                            <a href="{{ route('profile.show', $post->user) }}" class="font-medium text-neutral-950 hover:underline">
                                {{ $post->user->name }}
                            </a>

                            @auth
                                @if (Auth::id() !== $post->user_id)
                                    <span class="text-neutral-400">&middot;</span>
                                    <button class="font-medium text-green-700 hover:text-green-800" x-text="following ? 'Following' : 'Follow'" @click="follow()"></button>
                                @endif
                            @else
                                <span class="text-neutral-400">&middot;</span>
                                <a href="{{ route('login') }}" class="font-medium text-green-700 hover:text-green-800">Follow</a>
                            @endauth
                        </x-follow-container>

                        <div class="mt-1 flex flex-wrap items-center gap-2 text-sm text-neutral-500">
                            <span>{{ $post->readTime() }} min read</span>
                            <span>&middot;</span>
                            <span>{{ $post->createdAt() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            @if ($post->user_id === Auth::id())
                <div class="mt-6 flex flex-wrap items-center gap-3">
                    <x-secondary-button onclick="window.location='{{ route('post.edit', $post) }}'">
                        Edit story
                    </x-secondary-button>
                    <form action="{{ route('post.destroy', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-danger-button>
                            Delete
                        </x-danger-button>
                    </form>
                </div>
            @endif
        </header>

        <div class="mt-8">
            <x-clap-button :post="$post" />
        </div>

        @if ($post->imageUrl('large'))
            <img src="{{ $post->imageUrl('large') }}" alt="{{ $post->title }}" class="mt-10 aspect-video w-full rounded-md object-cover">
        @endif

        <div class="prose prose-neutral mt-10 max-w-none prose-p:leading-8 prose-img:rounded-md">
            <p>{!! nl2br(e($post->content)) !!}</p>
        </div>

        @if ($post->category)
            <footer class="mt-10 border-t border-neutral-200 pt-6">
                <a href="{{ route('post.byCategory', $post->category) }}" class="rounded-full bg-neutral-100 px-4 py-2 text-sm font-medium text-neutral-700 transition hover:bg-neutral-200">
                    {{ $post->category->name }}
                </a>
            </footer>
        @endif
    </article>
</x-app-layout>
