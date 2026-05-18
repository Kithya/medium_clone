<section>
    <header>
        <h2 class="text-xl font-semibold text-neutral-950">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-2 text-sm leading-6 text-neutral-600">
            {{ __('Update your name, handle, photo, bio, and email address.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="flex items-center gap-4">
            <x-user-avatar :user="$user" size="h-16 w-16" />
            <div class="text-sm text-neutral-600">
                <p class="font-medium text-neutral-950">{{ $user->name }}</p>
                <p>@{{ $user->username }}</p>
            </div>
        </div>

        <div>
            <x-input-label for="image" :value="__('Avatar')" />
            <x-text-input id="image" class="mt-2 block w-full" type="file" name="image" accept="image/*" />
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-2 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" name="username" type="text" class="mt-2 block w-full" :value="old('username', $user->username)"
                required autofocus autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-2 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="bio" :value="__('Bio')" />
            <x-input-textarea id="bio" class="mt-2 block w-full" name="bio">{{ old('bio', $user->bio) }}</x-input-textarea>
            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-neutral-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
