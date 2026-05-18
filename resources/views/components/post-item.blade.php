<article class="border-b border-neutral-200 py-8">
    <div class="flex gap-5 sm:gap-8">
        <div class="min-w-0 flex-1">
            <div class="flex items-center gap-2 text-sm text-neutral-600">
                <x-user-avatar :user="$post->user" size="h-6 w-6" />
                <a href="{{ route('profile.show', $post->user) }}" class="font-medium text-neutral-800 hover:text-neutral-950">
                    {{ $post->user->name }}
                </a>
                <span>&middot;</span>
                <span>{{ $post->createdAt() }}</span>
            </div>

            <a href="{{ route('post.show', ['username' => $post->user->username, 'post' => $post->slug]) }}" class="mt-3 block group">
                <h2 class="text-xl font-semibold leading-snug tracking-normal text-neutral-950 group-hover:text-neutral-700 sm:text-2xl">
                    {{ $post->title }}
                </h2>
                <p class="mt-2 hidden max-w-2xl text-sm leading-6 text-neutral-600 sm:block">
                    {{ $post->excerpt() }}
                </p>
            </a>

            <div class="mt-4 flex flex-wrap items-center gap-3 text-sm text-neutral-500">
                @if ($post->category)
                    <a href="{{ route('post.byCategory', $post->category) }}" class="rounded-full bg-neutral-100 px-3 py-1 text-xs font-medium text-neutral-700 transition hover:bg-neutral-200">
                        {{ $post->category->name }}
                    </a>
                @endif
                <span>{{ $post->readTime() }} min read</span>
                <span>&middot;</span>
                <span class="inline-flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" aria-label="clap">
                        <path fill-rule="evenodd" d="M14.741 8.309c-.18-.267-.446-.455-.728-.502a.67.67 0 0 0-.533.127c-.146.113-.59.458-.199 1.296l1.184 2.503a.448.448 0 0 1-.236.755.445.445 0 0 1-.483-.248L7.614 6.106A.816.816 0 1 0 6.459 7.26l3.643 3.644a.446.446 0 1 1-.631.63L5.83 7.896l-1.03-1.03a.82.82 0 0 0-1.395.577.81.81 0 0 0 .24.576l1.027 1.028 3.643 3.643a.444.444 0 0 1-.144.728.44.44 0 0 1-.486-.098l-3.64-3.64a.82.82 0 0 0-1.335.263.81.81 0 0 0 .178.89l1.535 1.534 2.287 2.288a.445.445 0 0 1-.63.63l-2.287-2.288a.813.813 0 0 0-1.393.578c0 .216.086.424.238.577l4.403 4.403c2.79 2.79 5.495 4.119 8.681.931 2.269-2.271 2.708-4.588 1.342-7.086z" clip-rule="evenodd"></path>
                    </svg>
                    {{ $post->claps_count ?? 0 }}
                </span>
            </div>
        </div>

        <a href="{{ route('post.show', ['username' => $post->user->username, 'post' => $post->slug]) }}" class="mt-8 hidden h-28 w-36 shrink-0 overflow-hidden rounded-md bg-neutral-100 sm:block">
            @if ($post->imageUrl('preview'))
                <img class="h-full w-full object-cover" src="{{ $post->imageUrl('preview') }}" alt="{{ $post->title }}">
            @else
                <div class="flex h-full w-full items-center justify-center bg-neutral-100 text-3xl font-semibold text-neutral-300">
                    M
                </div>
            @endif
        </a>
    </div>
</article>
