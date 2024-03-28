<x-splade-link :href="route('home')" class="flex items-center p-2 text-xl rounded-lg hover:bg-zinc-700 group transition-all">
    <i class="bx bx-home text-zinc-100 transition duration-75 group-hover:text-white"></i>
    <span class="ms-3 text-zinc-300 group-hover:text-white">{{__('Home')}}</span>
</x-splade-link>

@foreach(menu('main') as $item)
    @if(str($item->url)->contains('profile') && auth('accounts')->user())
        @if($item->target === '_blank')
            <a href="{{ $item->url }}" target="_blank" class="flex items-center p-2 text-xl rounded-lg hover:bg-zinc-700 group transition-all">
                <i class="{{$item->icon}} text-zinc-100 transition duration-75 group-hover:text-white"></i>
                <span class="ms-3 text-zinc-300 group-hover:text-white">{{$item->name}}</span>
            </a>
        @else
            <x-splade-link :href="$item->url" class="flex items-center p-2 text-xl rounded-lg hover:bg-zinc-700 group transition-all">
                <i class="{{$item->icon}} text-zinc-100 transition duration-75 group-hover:text-white"></i>
                <span class="ms-3 text-zinc-300 group-hover:text-white">{{$item->name}}</span>
            </x-splade-link>
        @endif
    @else
        @if($item->target === '_blank')
            <a href="{{ $item->url }}" target="_blank" class="flex items-center p-2 text-xl rounded-lg hover:bg-zinc-700 group transition-all">
                <i class="{{$item->icon}} text-zinc-100 transition duration-75 group-hover:text-white"></i>
                <span class="ms-3 text-zinc-300 group-hover:text-white">{{$item->name}}</span>
            </a>
        @else
            <x-splade-link :href="$item->url" class="flex items-center p-2 text-xl rounded-lg hover:bg-zinc-700 group transition-all">
                <i class="{{$item->icon}} text-zinc-100 transition duration-75 group-hover:text-white"></i>
                <span class="ms-3 text-zinc-300 group-hover:text-white">{{$item->name}}</span>
            </x-splade-link>
        @endif
    @endif
@endforeach

@if(auth('accounts')->user())
    <x-splade-link :href="route('profile.index')" class="flex items-center p-2 text-xl rounded-lg hover:bg-zinc-700 group transition-all">
        <i class="bx bx-user-circle text-zinc-100 transition duration-75 group-hover:text-white"></i>
        <span class="ms-3 text-zinc-300 group-hover:text-white">{{__('Profile')}}</span>
    </x-splade-link>
    <x-splade-link method="POST" :href="route('profile.logout')" class="flex items-center p-2 text-xl rounded-lg hover:bg-zinc-700 group transition-all">
        <i class="bx bx-log-out text-zinc-100 transition duration-75 group-hover:text-white"></i>
        <span class="ms-3 text-zinc-300 group-hover:text-white">{{__('Logout')}}</span>
    </x-splade-link>
@else
    <x-splade-link :href="route('account.login')" class="flex items-center p-2 text-xl rounded-lg hover:bg-zinc-700 group transition-all">
        <i class="bx bx-log-in text-zinc-100 transition duration-75 group-hover:text-white"></i>
        <span class="ms-3 text-zinc-300 group-hover:text-white">{{__('Login')}}</span>
    </x-splade-link>
    <x-splade-link :href="route('account.register')" class="flex items-center p-2 text-xl rounded-lg hover:bg-zinc-700 group transition-all">
        <i class="bx bx-user-plus text-zinc-100 transition duration-75 group-hover:text-white"></i>
        <span class="ms-3 text-zinc-300 group-hover:text-white">{{__('Register')}}</span>
    </x-splade-link>
@endif
