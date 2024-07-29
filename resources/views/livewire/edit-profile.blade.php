<div>
    <h1 class="mb-4 text-2xl text-slate-700 font-semibold">Update your profile...</h1>

    <form wire:submit="save()" class="min-w-[30rem] flex flex-col gap-6 bg-white rounded-lg shadow p-6">
        <label class="flex flex-col gap-2">
            <h3 class="font-medium text-slate-700 text-base">
                Username
                <span class="text-red-500 opacity-75" aria-hidden="true">*</span>
            </h3>

            <input
                wire:model.blur="form.username"
                @class([
                    'px-3 py-2  rounded-lg disabled:cursor-not-allowed disabled:opacity-75',
                    'border border-slate-300' => $errors->missing('form.username'),
                    'border-2 border-red-500' => $errors->has('form.username'),
                ])
                placeholder="Username...">


            @error('form.username')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </label>

        <label class="flex flex-col gap-2">
            <h3 class="font-medium text-slate-700 text-base">Bio</h3>

            <textarea wire:model="form.bio" rows="4"
                      class="px-3 py-2 border border-slate-300 rounded-lg disabled:cursor-not-allowed disabled:opacity-75"
                      placeholder="A little bit about yourself..."></textarea>
        </label>

        <label class="flex flex-col gap-2">
            <h3 class="font-medium text-slate-700 text-base">
                Country
                <span class="text-red-500 opacity-75" aria-hidden="true">*</span>
            </h3>

            <select
                wire:model.blur="form.country"
                @class([
                    'px-3 py-2  rounded-lg disabled:cursor-not-allowed disabled:opacity-75',
                    'border border-slate-300' => $errors->missing('form.country'),
                    'border-2 border-red-500' => $errors->has('form.country'),
                ])
            >

                <option value="" selected disabled>Choose your country</option>
                @foreach(App\Enums\Country::cases() as $country)
                    <option value="{{ $country->value }}"> {{ $country->label() }}</option>
                @endforeach
            </select>

            @error('form.country')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </label>

        <fieldset class="flex flex-col gap-2">
            <div>
                <legend class="font-medium text-slate-700 text-base">Receive Emails?</legend>
            </div>

            <div class="flex items-center space-x-6">
                <label class="flex items-center gap-2">
                    <input
                        wire:model.boolean="form.receive_emails"
                        name="receive_emails"
                        value="true"
                        type="radio">Yes
                </label>
                <label class="flex items-center gap-2">
                    <input
                        wire:model.boolean="form.receive_emails"
                        name="receive_emails"
                        value="false"
                        type="radio">No
                </label>
            </div>
        </fieldset>

        <fieldset
            x-show="$wire.form.receive_emails"
            class="flex flex-col gap-2">
            <div>
                <legend class="font-medium text-slate-700 text-base">What emails do you want to receive?</legend>
            </div>

            <div class="flex flex-col space-y-2">
                <label class="flex items-center gap-2">
                    <input
                        class="rounded-sm"
                        wire:model="form.receive_updates"
                        name="receive_emails"
                        type="checkbox">General updates
                </label>
                <label class="flex items-center gap-2">
                    <input
                        class="rounded-sm"
                        wire:model="form.receive_offers"
                        name="receive_emails"
                        type="checkbox">Marketing offers
                </label>
            </div>
        </fieldset>

        <div class="flex">
            <button type="submit"
                    class="relative w-full bg-blue-500 py-3 px-8 rounded-lg text-white font-medium disabled:cursor-not-allowed disabled:opacity-75">
                Save

                <div wire:loading.flex wire:target="save"
                     class="flex absolute top-0 right-0 bottom-0 flex items-center pr-4">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </button>
        </div>
    </form>

    <div
        x-show="$wire.showSuccessIndicator"
        x-transition.out.opacity.duration.1000
        x-effect="if($wire.showSuccessIndicator) setTimeout(() => $wire.showSuccessIndicator = false, 3000)"
        class="flex justify-end pt-4">
        <div class="flex gap-2 items-center text-green-500 text-sm font-medium">
            Profile updated successfully

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor"
                 class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
    </div>
</div>
