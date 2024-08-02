<x-radio-group class="grid grid-cols-5 gap-2" wire:model.live="filters.status">
    @foreach($filters->statuses() as $status)
        <x-radio-group.option
            :value="$status['value']"
            class-checked="border-blue-400"
            class-not-checked="text-gray-700"
            class="px-3 py-2 flex flex-col rounded-xl border hover:border-blue-400 text-gray-700 cursor-pointer">
            <div class="text-sm font-normal">
                <x-radio-group.label>{{ $status['label'] }}</x-radio-group.label>
            </div>

            <x-radio-group.description class="text-lg font-semibold">{{ $status['count'] }}</x-radio-group.description>
        </x-radio-group.option>
    @endforeach
</x-radio-group>
