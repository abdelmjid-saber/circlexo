<div class="bg-zinc-900 min-h-screen min-w-screen h-full w-full text-white">
    <x-circle-xo-header />
    <div class="h-full min-h-screen">
        <div class="h-[150px] lg:h-[350px] bg-zinc-700 bg-cover border-b border-zinc-700">
            @if(auth('accounts')->user()->cover)
                <x-splade-link modal :href="route('profile.cover.show')" class="flex flex-col justify-center items-center text-center h-full">
                    <img src="{{ auth('accounts')->user()->cover }}" class="w-full h-full bg-cover bg-center object-cover" alt="avatar">
                </x-splade-link>
            @else
                <x-splade-link modal :href="route('profile.cover.show')" class="flex flex-col justify-center items-center text-center h-full">
                    <i class="bx bx-upload text-5xl text-zinc-500"></i>
                    <h1>{{__('Upload a Cover')}}</h1>
                </x-splade-link>
            @endif
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3">
            <div class="justify-start gap-4 mt-8 mx-16 hidden lg:flex">
                <x-splade-link modal :href="route('profile.social.show')">
                    <i class="bx bx-plus-circle text-2xl text-main-600 hover:text-white"></i>
                </x-splade-link>
                @if(auth('accounts')->user()->meta('social'))
                    <x-circle-xo-social-links edit :account="auth('accounts')->user()"/>
                @endif
            </div>
            <div>
                <div class="flex justify-center flex-col items-center -mt-12 ">
                    @if(auth('accounts')->user()->avatar)
                        <x-splade-link modal href="{{ route('profile.avatar.show') }}" class="w-32 h-32 rounded-full bg-zinc-800 border border-zinc-700">
                            <img src="{{ auth('accounts')->user()->avatar }}" class="w-32 h-32 rounded-full object-cover" alt="avatar">
                        </x-splade-link>
                    @else
                        <x-splade-link modal href="{{ route('profile.avatar.show') }}" class="w-32 h-32 rounded-full bg-zinc-800 flex justify-center border border-zinc-700">
                            <div class="flex flex-col justify-center items-center text-center h-full">
                                <i class="bx bx-upload text-5xl text-zinc-500"></i>
                            </div>
                        </x-splade-link>
                    @endif

                </div>
                <div class="text-center flex flex-col mt-4">
                    <div class="flex justify-center gap-2  font-bold">
                        <x-splade-link :href="url(auth('accounts')->user()->username)"  class="text-2xl">{{ auth('accounts')->user()->name }}</x-splade-link>
                        @if(auth('accounts')->user()->type === 'verified')
                            <div class="flex flex-col justify-center items-center mt-2">
                                <x-tomato-admin-tooltip :text="__('Verified Account')">
                                    <i class="bx bxs-badge-check text-blue-400 text-xl"></i>
                                </x-tomato-admin-tooltip>
                            </div>
                        @endif
                        <x-splade-link modal :href="route('profile.info.show')" class="flex flex-col justify-center items-center mt-1">
                            <i class="bx bxs-edit text-green-500 text-lg"></i>
                        </x-splade-link>
                    </div>
                    <x-tomato-admin-copy :text="url('/' . auth('accounts')->user()->username)">
                        <div class="flex justify-center gap-2">
                            <i class="bx bx-copy text-sm text-main-600 mt-1"></i>
                            <h6 class="text-sm font-medium text-zinc-300">{{ auth('accounts')->user()->username }}</h6>
                        </div>
                    </x-tomato-admin-copy>
                    @if(auth('accounts')->user()->bio)
                        <p class="text-xs text-center my-2 mx-2">
                            {{ auth('accounts')->user()->bio }}
                        </p>
                    @endif

                    @if(auth('accounts')->user()->address)
                    <div class="flex justify-center gap-2 text-sm">
                        <i class="bx bxs-map mt-1 text-main-600 "></i>
                        <h1 class="text-zinc-300">
                            {{ auth('accounts')->user()->address }}
                        </h1>
                    </div>
                    @endif
                    <h6 class="my-2 text-sm text-zinc-300">{{__('Joined')}} {{ auth('accounts')->user()->created_at->diffForHumans() }}</h6>
                </div>
            </div>
            <div class="flex justify-center md:justify-end gap-4 mt-8 mx-16">
                <x-tomato-admin-tooltip :text="__('QR Generator')">
                    <x-splade-link modal href="{{route('profile.qr')}}" class="bg-success-600 text-white rounded-md shadow-md font-bold text-sm px-4 py-2">
                        <i class="bx bx-qr"></i>
                    </x-splade-link>
                </x-tomato-admin-tooltip>
                <x-tomato-admin-tooltip :text="__('Sponsoring')">
                    <x-splade-link modal href="{{route('profile.sponsoring.show')}}" class="bg-danger-600 text-white rounded-md shadow-md font-bold text-sm px-4 py-2">
                        <i class="bx bxs-heart"></i>
                    </x-splade-link>
                </x-tomato-admin-tooltip>
                <x-tomato-admin-tooltip :text="__('Settings')">
                    <x-tomato-admin-dropdown>
                        <x-slot:button>
                            <button>
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                        </x-slot:button>
                        <x-tomato-admin-dropdown-item modal type="link" icon="bx bx-edit" :label="__('Edit Profile')" href="{{ route('profile.info.show') }}" />
                        <x-tomato-admin-dropdown-item modal type="link" icon="bx bx-lock" :label="__('Edit Password')" href="{{ route('profile.password.show') }}" />
                        <x-tomato-admin-dropdown-item modal type="link" icon="bx bxl-twitter" :label="__('Link Social Account')" href="{{ route('profile.social-accounts.show') }}" />
                        <x-tomato-admin-dropdown-item modal type="link" icon="bx bx-plus-circle" :label="__('List Item')" href="{{ route('profile.listing.create') }}" />
                        <x-tomato-admin-dropdown-item type="link" icon="bx bx-message" :label="__('Messages')" href="{{ route('profile.messages') }}" />
                        <x-tomato-admin-dropdown-item type="link" icon="bx bxs-user-plus" :label="__('Following')" href="{{ route('profile.following') }}" />
                        <x-tomato-admin-dropdown-item type="link" method="DELETE" confirm-danger icon="bx bxs-trash" danger :label="__('Delete Account')" href="{{ route('profile.destroy') }}" />
                    </x-tomato-admin-dropdown>
                </x-tomato-admin-tooltip>
            </div>
            <div class="justify-center md:justify-start gap-4 my-8 mx-16 flex lg:hidden ">
                <x-splade-link modal :href="route('profile.social.show')">
                    <i class="bx bx-plus-circle text-2xl text-main-600 hover:text-white"></i>
                </x-splade-link>
                @if(auth('accounts')->user()->meta('social'))
                    <x-circle-xo-social-links edit :account="auth('accounts')->user()"/>
                @endif
            </div>
        </div>
        {{ $slot }}
    </div>
    <x-circle-xo-footer />
</div>
