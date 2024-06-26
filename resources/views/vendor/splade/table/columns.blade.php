<x-splade-component is="button-with-dropdown" dusk="columns-dropdown" class="w-full bg-white border border-zinc-200 rounded-md shadow-sm px-2.5 sm:px-4 py-2 inline-flex justify-center text-sm font-medium text-zinc-700 hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:hover:bg-zinc-600  dark:bg-zinc-700 dark:border-zinc-600">
    <x-slot:button>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
            :class="{
                'text-zinc-400': !table.columnsAreToggled,
                'text-green-400': table.columnsAreToggled,
            }">
            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
        </svg>
    </x-slot:button>

    <div class="px-2 dark:bg-zinc-800">
        <ul class="divide-y divide-zinc-200 dark:divide-zinc-700">
            @foreach($table->columns() as $column)
                @if(!$column->canBeHidden)
                    @continue
                @endif

                <li class="py-2 flex items-center justify-between">
                    <p class="text-sm text-zinc-900 dark:text-white">
                        {{ $column->label }}
                    </p>

                    <button
                        type="button"
                        class="ltr:ml-4 rtl:mr-4 relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-light-blue-500"
                        :class="{
                            'bg-green-500': table.columnIsVisible(@js($column->key)),
                            'bg-zinc-200': !table.columnIsVisible(@js($column->key)),
                        }"
                        :aria-pressed="table.columnIsVisible(@js($column->key))"
                        aria-labelledby="toggle-column-{{ $column->key }}"
                        aria-describedby="toggle-column-{{ $column->key }}"
                        @click.prevent="table.toggleColumn(@js($column->key))"
                        dusk="toggle-column-{{ $column->key }}"
                    >
                        <span class="sr-only">Column status</span>
                        <span
                            aria-hidden="true"
                            :class="{
                                'translate-x-5 rtl:-translate-x-5': table.columnIsVisible(@js($column->key)),
                                'translate-x-0': !table.columnIsVisible(@js($column->key)),
                            }"
                            class="inline-block h-5 w-5 rounded-full bg-white  shadow transform ring-0 transition ease-in-out duration-300" />
                    </button>
                </li>
            @endforeach
        </ul>
    </div>
</x-splade-component>
