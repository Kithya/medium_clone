@props(['user'])

@php
    $followersCount = $user->followers_count ?? $user->followers()->count();
@endphp

<div {{ $attributes->merge(['class' => '']) }} x-data="{
    following: {{ $user->isFollowedBy(auth()->user()) ? 'true' : 'false' }},
    followersCount: {{ $followersCount }},
    follow() {
        axios.post('{{ route('follow', $user) }}')
            .then(res => {
                this.following = ! this.following
                this.followersCount = res.data.followersCount
            })
            .catch(() => {})
    }
}">{{ $slot }}</div>
