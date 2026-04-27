<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="border border-default rounded-md">
                        <x-category-tabs>
                            No category
                        </x-category-tabs>
                    </div>

                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-8">
                <div class="p-6 text-gray-900 flex items-center flex-col gap-2 mt-5">
                    @forelse ($posts as $post)
                        <x-post-item :post="$post" />
                    @empty
                        <p class="text-gray-500 py-10">No posts found.</p>
                    @endforelse
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
