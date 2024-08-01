@props(['order'])

<x-menu>
    <x-menu.button class="rounded hover:bg-gray-200">
        <x-icon.ellipsis-horizontal/>
    </x-menu.button>

    <x-menu.items>
        <x-menu.close>
            <x-menu.item wire:confirm="Are you sure you want to refund this order?"
                         wire:click="refund({{ $order->id }})">
                Refund
            </x-menu.item>
        </x-menu.close>
        <x-menu.close>
            <x-menu.item wire:confirm="Are you sure you want to archive this order?"
                         wire:click="archive({{ $order->id }})">
                Archive
            </x-menu.item>
        </x-menu.close>
    </x-menu.items>
</x-menu>
