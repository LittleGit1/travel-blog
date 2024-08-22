@include('partials.head')

<main class="container mx-auto">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-gray-100 p-5 flex rounded-2xl shadow-lg max-w-3xl">
            <div class="md:w-1/2 px-5">
                <h2 class="text-2xl font-bold text-[#002D74]">Sign Up</h2>
                <p class="mt-4 text-sm text-[#002D74]">If you have an account, please <a href="{{ route('login') }}"
                        class="text-blue-700 hover:underline">login.</a>
                </p>
            </div>
            <form class="mt-6 md:w-1/2 px-5" method="POST"
                action="/signup{{ request()->query('redirect') ? '?redirect=' . request()->query('redirect') : '' }}">
                @csrf
                <!-- Name Input -->
                <div>
                    <label class="block text-gray-700">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter your name"
                        class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none {{ $errors->has('username') ? 'border-red-500' : '' }}"
                        value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <p class="text-red-500 mt-2 text-xs italic">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <!-- Username Input -->
                <div>
                    <label class="block text-gray-700">Username</label>
                    <input type="text" name="username" id="username" placeholder="Enter your username"
                        class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none {{ $errors->has('username') ? 'border-red-500' : '' }}"
                        value="{{ old('username') }}">
                    @if ($errors->has('username'))
                        <p class="text-red-500 mt-2 text-xs italic">{{ $errors->first('username') }}</p>
                    @endif
                </div>

                <!-- Email Input -->
                <div class="mt-4">
                    <label class="block text-gray-700">Email Address</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email address"
                        class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500
                             focus:bg-white focus:outline-none {{ $errors->has('email') ? 'border-red-500' : '' }}"
                        value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <p class="text-red-500 mt-2 text-xs italic">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <!-- Password Input -->
                <div class="mt-4">
                    <label class="block text-gray-700">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password"
                        minlength="6"
                        class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border
                             focus:border-blue-500 focus:bg-white focus:outline-none {{ $errors->has('password') ? 'border-red-500' : '' }}">
                    @if ($errors->has('password'))
                        <p class="text-red-500 mt-2 text-xs italic">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <!-- Retype Password Input -->
                <div class="mt-4">
                    <label class="block text-gray-700">Retype Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder="Retype your password"
                        class="w-full px-4 py-3 rounded-lg bg-gray-200
                               mt-2 border focus:border-blue-500
                               focus:bg-white focus:outline-none {{ $errors->has('password_confirmation') ? 'border-red-500' : '' }}">
                    @if ($errors->has('password_confirmation'))
                        <p class="text-red-500 mt-2 text-xs italic">{{ $errors->first('password_confirmation') }}</p>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit"
                        class="w-full block bg-blue-500 hover:bg-blue-400 focus:bg-blue-400 text-white font-semibold rounded-lg
                            px-4 py-3">Sign
                        Up
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
@include('partials.footer')
