<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('Skill') }}
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-admin-button href="{{route('admin.skills.create')}}">
            {{trans('tomato-admin::global.crud.create-new')}} {{__('Skill')}}
        </x-tomato-admin-button>
    </x-slot:buttons>


    <div class="pb-12" v-cloak>
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-splade-cell icon>
                    <x-tomato-admin-row table :value="$item->icon"  type="icon"/>
                </x-splade-cell>
                <x-splade-cell actions>
                    <div class="flex justify-start">
                        <x-tomato-admin-button type="icon" success modal title="{{trans('tomato-admin::global.crud.view')}}" href="{{ route('admin.skills.show', $item->id) }}">
                            <x-heroicon-s-eye class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button type="icon" warning title="{{trans('tomato-admin::global.crud.edit')}}" href="{{ route('admin.skills.edit', $item->id) }}">
                            <x-heroicon-s-pencil class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button type="icon" title="{{trans('tomato-admin::global.crud.delete')}}" href="{{ route('admin.skills.destroy', $item->id) }}"
                                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                               class="px-2 text-red-500"
                                               method="delete"

                        >
                            <x-heroicon-s-trash class="h-6 w-6"/>
                        </x-tomato-admin-button>

                    </div>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-tomato-admin-layout>
