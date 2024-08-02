<div class="flex flex-col gap-5">
    {{-- Add todo --}}
    <form wire:submit="add">
        <div class="flex gap-2">
            <input
                wire:model="draft"
                type="text" class="grow rounded-full shadow px-5 py-3"
                placeholder="Today I'm gonna...">
        </div>
    </form>

    {{-- Todo list --}}
    <div class="grid gap-3 min-w-[24rem]" x-sort="$wire.sort($item, $position)">
        @foreach ($this->todos as $todo)
            <div
                x-sort:item="{{ $todo->id }}"
                wire:key="{{ $todo->id }}"
                class="group p-1.5 flex justify-between items-center bg-slate-100 rounded-full shadow shadow-slate-300"
            >
                <div class="px-3 py-1 text-sm text-slate-600">{{ $todo->name }}</div>

                <button wire:click="remove({{ $todo->id }})"
                        class="opacity-0 group-hover:opacity-100 text-slate-500 hover:bg-emerald-100/75 hover:text-emerald-700 rounded-full p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                        <path fill-rule="evenodd"
                              d="M12.416 3.376a.75.75 0 0 1 .208 1.04l-5 7.5a.75.75 0 0 1-1.154.114l-3-3a.75.75 0 0 1 1.06-1.06l2.353 2.353 4.493-6.74a.75.75 0 0 1 1.04-.207Z"
                              clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        @endforeach
    </div>
</div>
