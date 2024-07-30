<div>
    <x-dialog wire:model="show">
        <x-dialog.open>
            <button type="button"
                    class="text-lg text-center rounded-xl bg-blue-500 text-white px-6 py-2 font-semibold disabled:cursor-not-allowed disabled:opacity-50"
                    wire:loading.attr="disabled">
                New Post
            </button>
        </x-dialog.open>

        <x-dialog.panel>
            <form wire:submit="add" class="flex flex-col gap-4">
                <h2 class="text-3xl font-bold mb-1">
                    Write your new post!
                </h2>

                <hr>

                <label class="flex flex-col gap2">
                    Title
                    <input wire:model.blur="form.title"
                           class="px-3 py-2 border font-normal rounded-lg border-slate-300 read-only:opacity-50 read-only:cursor-not-allowed"
                           autofocus>
                    @error('form.title')
                    <span class="text-sm text-red-500 font-normal">{{ $message }}</span>
                    @enderror
                </label>

                <label class="flex flex-col gap2">
                    Content
                    <textarea
                        wire:model.blur="form.content"
                        class="px-3 py-2 border font-normal rounded-lg border-slate-300 read-only:opacity-50 read-only:cursor-not-allowed"
                        rows="5"></textarea>
                    @error('form.content')
                    <span class="text-sm text-red-500 font-normal">{{ $message }}</span>
                    @enderror
                </label>

                <x-dialog.footer>
                    <x-dialog.close>
                        <button
                            type="button"
                            class="text-lg text-center rounded-xl bg-slate-300 text-slate-800 px-6 py-2 font-semibold">
                            Cancel
                        </button>
                    </x-dialog.close>

                    <button
                        type="submit"
                        class="text-lg text-center rounded-xl bg-blue-500 text-white px-6 py-2 font-semibold disabled:cursor-not-allowed disabled:opacity-50">
                        Save
                    </button>
                </x-dialog.footer>
            </form>
        </x-dialog.panel>
    </x-dialog>
</div>
