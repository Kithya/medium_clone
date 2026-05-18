<x-app-layout>
    <div class="mx-auto max-w-3xl px-4 py-10 sm:px-6 lg:px-8">
        <header class="border-b border-neutral-200 pb-6">
            <h1 class="text-4xl font-semibold tracking-normal text-neutral-950">Settings</h1>
            <p class="mt-3 text-base leading-7 text-neutral-600">Manage how readers see you and keep your account secure.</p>
        </header>

        <div class="mt-8 space-y-10">
            <section class="border-b border-neutral-200 pb-10">
                @include('profile.partials.update-profile-information-form')
            </section>

            <section class="border-b border-neutral-200 pb-10">
                @include('profile.partials.update-password-form')
            </section>

            <section>
                @include('profile.partials.delete-user-form')
            </section>
        </div>
    </div>
</x-app-layout>
