<select
    name="per_page"
    class="block dark:bg-zinc-700 dark:border-zinc-600 focus:ring-indigo-500 focus:border-indigo-500 min-w-max shadow-sm text-sm border-zinc-300 rounded-md"
    @change="table.updateQuery('perPage', $event.target.value)"
  >
    @foreach($table->allPerPageOptions() as $perPage)
        <option value="{{ $perPage }}" @selected($perPage === $table->perPage())>
            {{ $perPage }} {{ __('per page') }}
        </option>
    @endforeach
</select>
