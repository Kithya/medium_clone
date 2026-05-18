<x-app-layout>
    <div class="mx-auto max-w-4xl px-4 py-10 sm:px-6 lg:px-8">
        <section class="min-w-0">
            <header class="border-b border-neutral-200 pb-8">
                <div class="flex items-start gap-5">
                    <x-user-avatar :user="$user" size="h-16 w-16 sm:h-20 sm:w-20" />
                    <div class="min-w-0">
                        <h1 class="text-3xl font-semibold tracking-normal text-neutral-950 sm:text-5xl">{{ $user->name }}</h1>
                        <p class="mt-1 text-sm text-neutral-500">@{{ $user->username }}</p>
                    </div>
                </div>

                @if ($user->bio)
                    <p class="mt-5 max-w-2xl text-base leading-7 text-neutral-700">{{ $user->bio }}</p>
                @endif

                <x-follow-container :user="$user" class="mt-6 flex flex-wrap items-center gap-4">
                    <p class="text-sm text-neutral-500"><span x-text="followersCount"></span> followers</p>

                    @auth
                        @if (Auth::id() !== $user->id)
                            <button class="rounded-full bg-green-700 px-5 py-2 text-sm font-medium text-white transition hover:bg-green-800" x-text="following ? 'Following' : 'Follow'" @click="follow()"></button>
                        @else
                            <x-secondary-button onclick="window.location='{{ route('profile.edit') }}'">
                                Edit profile
                            </x-secondary-button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="rounded-full bg-green-700 px-5 py-2 text-sm font-medium text-white transition hover:bg-green-800">
                            Follow
                        </a>
                    @endauth
                </x-follow-container>
            </header>

            <div>
                @forelse ($posts as $post)
                    <x-post-item :post="$post" />
                @empty
                    <div class="py-16 text-center">
                        <h2 class="text-xl font-semibold text-neutral-950">No stories yet.</h2>
                        <p class="mt-2 text-sm text-neutral-600">{{ $user->name }} has not published anything yet.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        </section>
    </div>
</x-app-layout>
