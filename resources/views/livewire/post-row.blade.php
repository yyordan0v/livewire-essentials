<tr class="text-left text-slate-900">
    <td class="pl-6 py-4 pr-3 font-medium">{{ $post->title }}</td>
    <td class="pl-4 py-4 text-left text-slate-500">{{ str($post->content)->limit(50) }}</td>
    <td class="pl-4 py-4 text-right pr-6 flex gap-2 justify-end">

        <x-dialog wire:model="showEditDialog">
            <x-dialog.open>
                <button type="button" class="font-medium text-blue-600" wire:loading.attr="disabled">
                    Edit
                </button>
            </x-dialog.open>

            <x-dialog.panel>
                <form wire:submit="save" class="flex flex-col gap-4 text-left">
                    <h2 class="text-3xl font-bold mb-1">
                        Edit your post!
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


        <x-dialog>
            <x-dialog.open>
                <button type="button" class="font-medium text-red-600" wire:loading.attr="disabled">
                    Delete
                </button>
            </x-dialog.open>

            <x-dialog.panel>
                <div class="flex flex-col gap-6 text-left" x-data="{ confirmation: '' }">
                    <h2 class="font-semibold text-3xl">Are you sure you?</h2>
                    <h2 class="text-lg text-slate-700">This operation is permanent and can't be
                        reversed.
                        This post will be deleted forever.</h2>

                    <label class="flex flex-col gap-2">
                        Type "Confirm"
                        <input x-model="confirmation"
                               class="px-3 py-2 border border-slate-300 rounded-lg"
                               placeholder="Confirm">
                    </label>

                    <x-dialog.footer>
                        <x-dialog.close>
                            <button
                                class="text-lg text-center rounded-xl bg-slate-300 text-slate-800 px-6 py-2 font-semibold">
                                Cancel
                            </button>
                        </x-dialog.close>

                        <x-dialog.close>
                            <button
                                :disabled="confirmation !== 'Confirm'"
                                wire:click="$dispatch('deleted')"
                                class="text-lg text-center rounded-xl bg-red-500 text-white px-6 py-2 font-semibold disabled:cursor-not-allowed disabled:opacity-50">
                                Delete
                            </button>
                        </x-dialog.close>
                    </x-dialog.footer>
                </div>
            </x-dialog.panel>
        </x-dialog>
    </td>
</tr>
