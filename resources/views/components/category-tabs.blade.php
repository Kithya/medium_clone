<ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-body justify-center">
    <li class="me-2">
        <a class="inline-flex items-center justify-center p-4 border-b-2 border-blue-500 text-blue-600 rounded-t-lg">
            ALL
        </a>
    </li>
    @foreach ($categories as $category)
        <li class="me-2">
            <a href="#"
                class="inline-flex items-center justify-center p-4 border-b border-transparent rounded-t-base hover:text-fg-brand hover:border-brand group">

                {{ $category->name }}
            </a>
        </li>
    @endforeach
</ul>
