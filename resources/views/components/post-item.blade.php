 <a href="{{ route('post.show', ['username' => $post->user->username, 'post' => $post->slug]) }}"
     class="flex flex-col items-center bg-neutral-primary-soft p-4 border-b border-b-gray-200 rounded-base shadow-xs md:flex-row md:max-w-4xl">
     <div class="flex flex-col justify-between md:p-4 leading-normal">
         <h5 class="mb-2 text-2xl font-bold tracking-tight text-heading">{{ $post->title }}</h5>
         <p class="mb-4 max-w-xl">{{ $post->content }}</p>
         <div>
             <button type="button"
                 class="inline-flex items-center w-auto text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                 Read more
                 <svg class="w-4 h-4 ms-1.5 rtl:rotate-180 -me-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                     width="24" height="24" fill="none" viewBox="0 0 24 24">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M19 12H5m14 0-4 4m4-4-4-4" />
                 </svg>
             </button>
         </div>
     </div>
     <img class="object-cover w-full h-36 md:h-30 mb-4 md:mb-5 md:w-60"
         src="{{ $post->image ? Storage::url($post->image) : 'https://flowbite.com/docs/images/blog/image-4.jpg' }}"
         alt="{{ $post->title }}">
 </a>
