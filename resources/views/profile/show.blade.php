<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex">
                    <div class="flex-1 pr-7">
                        <h1 class="text-5xl text-bold">{{ $user->name }}</h1>

                        <div class="mt-6">
                            @forelse ($posts as $post)
                                <x-post-item :post="$post" />
                            @empty
                                <p class="text-gray-500 py-10">No posts found.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="w-[320px] border-l px-8">
                        <x-user-avatar :user="$user" size="w-24 h-24 ml-[-10px]" />

                        <h3>{{ $user->name }}</h3>
                        <p>26k Followers</p>
                        <p class="mt-3">{{ $user->bio }}</p>

                        <div class="mt-5">
                            <button class="px-5 py-2 bg-black text-white rounded-full">Follow</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
