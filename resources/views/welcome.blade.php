<div class="h-screen flex flex-col justify-center items-center gap-4 bg-gray-900">
    <x-splade-link :href="route('login')">
        <svg width="139" height="56" viewBox="0 0 139 56" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M85.6205 33.1108H74.5852V44.1512H82.9435V55.1865H93.9788V44.1512H85.6205V33.1108Z" fill="#F8CF00"/>
            <path d="M63.5447 33.1108H52.5094V44.1512H44.1511V55.1865H55.1915V44.1512H63.5447V33.1108Z" fill="#F8CF00"/>
            <path d="M74.5852 22.0756H85.6205V11.0352H93.9788V0H82.9435V11.0352H74.5852V22.0756Z" fill="#F8CF00"/>
            <path d="M33.1159 11.0352V0H22.0755H11.0403V11.0352H22.0755H33.1159Z" fill="#F8CF00"/>
            <path d="M63.5448 22.0756V11.0352H55.1916V0H44.1512V11.0352H33.116V22.0756V33.1109V44.1512H44.1512V33.1109V22.0756V11.0352H52.5096V22.0756H63.5448V33.1109H74.5852V22.0756H63.5448Z" fill="#F8CF00"/>
            <path d="M116.054 0H105.019V11.0352H116.054H127.09V0H116.054Z" fill="#F8CF00"/>
            <path d="M127.09 11.0353V22.0757V33.1109V44.1513H138.13V33.1109V22.0757V11.0353H127.09Z" fill="#F8CF00"/>
            <path d="M105.019 22.2343V22.0756V11.1939H93.9788V22.0756V22.2343V33.1109V44.1512H105.019V33.1109V22.2343Z" fill="#F8CF00"/>
            <path d="M105.019 44.1512V55.1865H116.054H127.09V44.1512H116.054H105.019Z" fill="#F8CF00"/>
            <path d="M11.0403 44.1512V55.1865H22.0755H33.1159V44.1512H22.0755H11.0403Z" fill="#F8CF00"/>
            <path d="M11.0404 22.0757V11.0353H0V22.0757V33.1109V44.1513H11.0404V33.1109V22.0757Z" fill="#F8CF00"/>
        </svg>
    </x-splade-link>
    <div class="text-center">
        <h1 class="font-bold text-3xl text-white">{{ config('app.name') }}</h1>
        <p class="text-gray-400 text-lg"> <b>Laravel</b> v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
        <p class="text-gray-400"><b>Tomato</b> v{{ \Composer\InstalledVersions::getVersion('tomatophp/tomato-admin') }} | <a target="_blank" href="https://docs.tomatophp.com" class="underline"><i class="bx bx-file text-md text-green-500"></i> Docs</a> | <a target="_blank" href="https://discord.gg/VZc8nBJ3ZU" class="underline"><i class="bx bxl-discord text-md  text-primary-500"></i> Discord</a> | <a target="_blank" href="https://github.com/sponsors/3x1io" class="underline"><i class="bx bxs-heart text-danger-500 text-md"></i> Sponsor</a> | <a target="_blank" href="https://github.com/tomatophp" class="underline"><i class="bx bxl-github text-white text-md"></i> GitHub</a></p>
    </div>
</div>
