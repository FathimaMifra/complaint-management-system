<section>
    <p class="text-sm text-gray-600 mb-6">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </p>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-2 px-3 py-2 block w-full border-gray-300 focus:border-sky-500 focus:ring-sky-500 rounded-lg shadow-sm" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-2 px-3 py-2 block w-full border-gray-300 focus:border-sky-500 focus:ring-sky-500 rounded-lg shadow-sm" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-2 px-3 py-2 block w-full border-gray-300 focus:border-sky-500 focus:ring-sky-500 rounded-lg shadow-sm" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end pt-4 border-gray-200">
            <button type="submit" class="inline-flex items-center px-6 py-3 bg-sky-900 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:bg-sky-700 focus:bg-sky-700 active:bg-sky-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 transition ease-in-out duration-150 shadow-sm hover:shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ __('Update Password') }}
            </button>
        </div>
    </form>
</section>
