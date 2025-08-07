@extends('layouts.app')

@section('content')
<section class="min-h-screen flex items-center justify-center bg-gray-50 px-4">
  <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-3xl font-bold text-center text-blue-600 mb-6">Create an Account</h2>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <!-- Name -->
      <div class="mb-4">
        <label for="name" class="block text-gray-700 font-semibold mb-1">Name</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
          class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />
        @error('name')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
      </div>

      <!-- Email -->
      <div class="mb-4">
        <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
          class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />
        @error('email')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
      </div>

      <!-- Password -->
      <div class="mb-4">
        <label for="password" class="block text-gray-700 font-semibold mb-1">Password</label>
        <input id="password" type="password" name="password" required autocomplete="new-password"
          class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />
        @error('password')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
      </div>

      <!-- Confirm Password -->
      <div class="mb-6">
        <label for="password_confirmation" class="block text-gray-700 font-semibold mb-1">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required
          autocomplete="new-password"
          class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />
        @error('password_confirmation')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
      </div>

      <div class="flex items-center justify-between">
        <a href="{{ route('login') }}" class="text-sm text-blue-500 hover:underline">Already registered?</a>
        <button type="submit"
          class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded">
          Register
        </button>
      </div>
    </form>
  </div>
</section>
@endsection
