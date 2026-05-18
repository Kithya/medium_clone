<nav x-data="{ open: false }" class="border-b border-neutral-200 bg-white">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between gap-4">
            <div class="flex min-w-0 items-center gap-8">
                <a href="{{ route('dashboard') }}" class="flex shrink-0 items-center gap-2">
                    <x-application-logo class="h-8 w-auto" />
                </a>

                <div class="hidden items-center gap-6 text-sm text-neutral-600 sm:flex">
                    <a href="{{ route('dashboard') }}" @class(['font-medium text-neutral-950' => request()->routeIs('dashboard'), 'hover:text-neutral-950' => ! request()->routeIs('dashboard')])>
                        Home
                    </a>
                    @auth
                        <a href="{{ route('myPosts') }}" @class(['font-medium text-neutral-950' => request()->routeIs('myPosts'), 'hover:text-neutral-950' => ! request()->routeIs('myPosts')])>
                            My stories
                        </a>
                    @endauth
                </div>
            </div>

            <div class="hidden items-center gap-4 sm:flex">
                <a href="{{ route('post.create') }}" class="inline-flex items-center gap-2 text-sm text-neutral-600 transition hover:text-neutral-950">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M4 20h4.5L19 9.5 14.5 5 4 15.5V20Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                        <path d="M13 6.5 17.5 11" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                    </svg>
                    Write
                </a>

                @auth
                    <x-dropdown align="right" width="48" contentClasses="py-2 bg-white">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-2 rounded-full border border-neutral-200 py-1 pl-1 pr-3 text-sm font-medium text-neutral-700 transition hover:border-neutral-300 hover:text-neutral-950 focus:outline-none focus:ring-2 focus:ring-neutral-950 focus:ring-offset-2">
                                <x-user-avatar :user="Auth::user()" size="h-8 w-8" />
                                <span class="max-w-32 truncate">{{ Auth::user()->name }}</span>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.show', Auth::user())">
                                Public profile
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')">
                                Settings
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('myPosts')">
                                My stories
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    Sign out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="text-sm text-neutral-600 transition hover:text-neutral-950">Sign in</a>
                    <a href="{{ route('register') }}" class="rounded-full bg-neutral-950 px-4 py-2 text-sm font-medium text-white transition hover:bg-neutral-800">
                        Get started
                    </a>
                @endguest
            </div>

            <button @click="open = ! open" class="inline-flex h-10 w-10 items-center justify-center rounded-full text-neutral-600 transition hover:bg-neutral-100 hover:text-neutral-950 focus:outline-none focus:ring-2 focus:ring-neutral-950 focus:ring-offset-2 sm:hidden" aria-label="Open navigation">
                <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M4 12h16M4 17h16" />
                    <path :class="{ 'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': ! open }" class="hidden border-t border-neutral-200 bg-white sm:hidden">
        <div class="space-y-1 px-4 py-3">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Home
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('post.create')" :active="request()->routeIs('post.create')">
                Write
            </x-responsive-nav-link>

            @auth
                <x-responsive-nav-link :href="route('myPosts')" :active="request()->routeIs('myPosts')">
                    My stories
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('profile.show', Auth::user())" :active="request()->routeIs('profile.show')">
                    Public profile
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                    Settings
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        Sign out
                    </x-responsive-nav-link>
                </form>
            @endauth

            @guest
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    Sign in
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                    Get started
                </x-responsive-nav-link>
            @endguest
        </div>
    </div>
</nav>
