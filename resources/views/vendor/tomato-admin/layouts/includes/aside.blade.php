<div
        v-cloak
        v-show="data.makeMenuHide"
        @click.prevent="data.makeMenuHide = !data.makeMenuHide"
        class="fixed inset-0 z-20 w-full h-full filament-sidebar-close-overlay lg:hidden"
>

</div>
<aside
        :class="{
            'hidden': !data.makeMenuHide,
            'w-24': data.makeMenuMin,
            'w-72': !data.makeMenuMin
        }"
        class="
                    lg:flex
                    filament-sidebar-open
                    translate-x-0
                    max-w-[20em]
                    lg:max-w-[var(--sidebar-width)]
                    filament-sidebar
                    fixed
                    inset-y-0
                    left-0
                    rtl:left-auto
                    rtl:right-0
                    z-20
                    flex
                    flex-col
                    h-screen
                    overflow-hidden
                    shadow-2xl
                    transition-all
                    bg-zinc-800
                    lg:z-0
                    dark:bg-zinc-800
                    filament-sidebar-open
                    translate-x-0
                    max-w-[20em]
                    lg:max-w-[var(--sidebar-width)]
                ">

    <header
            class="
                bg-zinc-900
                filament-sidebar-header
                h-[4rem]
                shrink-0
                px-6 flex items-center dark:border-zinc-700"
    >
        @if(count(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getLogoSection()))
            @foreach(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getLogoSection() as $item)
                @include($item)
            @endforeach
        @else
        <Link
                href="{{route('admin')}}"
                class="block w-fulls font-bold"
                v-show="true"
                data-turbo="false"
                style=""
        >
            <x-tomato-application-logo class="block h-9 w-auto fill-current text-primary-500" />
        </Link>
        @endif
    </header>

    <nav class="pb-6 overflow-y-auto filament-sidebar-nav" @preserveScroll('sidebar')>
        <div>
            @include('tomato-admin::layouts.includes.menu')
        </div>
    </nav>
</aside>
