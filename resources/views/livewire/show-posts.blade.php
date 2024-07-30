<div class="flex flex-col gap-8 w-[50rem] px-4">
    <div class="flex justify-between">
        <h1 class="text-3xl font-semibold leading-6 text-slate-900">Blog Posts</h1>

        <livewire:add-post-dialog @added="$refresh"/>
    </div>

    <table class="min-w-full divide-y divide-slate-300 bg-white shadow rounded-xl">
        <thead>
        <tr class="text-left text-slate-800">
            <th class="pl-6 rounded-tl-xl py-4 font-semibold bg-slate-50">Title</th>
            <th class="pl-4 py-4 font-semibold bg-slate-50 hidden sm:table-cell">Content</th>
            <th class="pl-4 rounded-tr-xl pr-4 bg-slate-50"></th>
        </tr>
        </thead>

        <tbody class="divide-y divide-slate-200" wire:loading.class="opacity-50">
        @foreach ($posts as $post)
            <livewire:post-row :key="$post->id" :$post @deleted="delete({{ $post->id }})"/>
        @endforeach
        </tbody>
    </table>
</div>
