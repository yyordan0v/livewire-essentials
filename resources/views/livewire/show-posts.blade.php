<div class="flex flex-col gap-8 min-w-[40rem]">
    <h1 class="text-3xl font-semibold leading-6 text-slate-900">Blog Posts</h1>

    <div class="shadow rounded-xl overflow-hidden bg-white">
        <table class="min-w-full divide-y divide-slate-300">
            <thead class="bg-slate-50 py-2">
            <tr class="text-left text-slate-800 font-semibold">
                <th class="pl-6 py-4">Title</th>
                <th class="pl-4 py-4">Content</th>
                <th class="pl-4 pr-4">
                    <livewire:add-post-dialog @added="$refresh"/>
                </th>
            </tr>
            </thead>

            <tbody class="divide-y divide-slate-200" wire:loading.class="opacity-50">
            @foreach ($posts as $post)
                <livewire:post-row :key="$post->id" :$post @deleted="delete({{ $post->id }})"/>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
