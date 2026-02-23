<section>
    <p class="text-sm text-gray-600 mb-6">
        {{ __("Update your account's profile information and email address.") }}
    </p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-2 px-3 py-2 block w-full border-gray-300 focus:border-sky-500 focus:ring-sky-500 rounded-lg shadow-sm" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" name="email" type="email" class="mt-2 px-3 py-2 block w-full border-gray-300 focus:border-sky-500 focus:ring-sky-500 rounded-lg shadow-sm" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <p class="text-sm text-yellow-800 mb-2">
                        {{ __('Your email address is unverified.') }}
                    </p>
                    <button form="send-verification" class="text-sm font-medium text-sky-900 hover:text-sky-700 underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 rounded">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-green-700">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center justify-end pt-4 border-gray-200">
            <button type="submit" class="inline-flex items-center px-6 py-3 bg-sky-900 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:bg-sky-700 focus:bg-sky-700 active:bg-sky-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 transition ease-in-out duration-150 shadow-sm hover:shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ __('Save Changes') }}
            </button>
        </div>
    </form>
</section>
