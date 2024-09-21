{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

<x-guest-layout>
    @vite(['resources/js/app.js'])
    <div class="auth-full-page d-flex">
        <div class="auth-form p-3">

            <div class="text-center">
                <h1 class="h2">Welcome back!</h1>
                <p class="lead">
                    Log in to your account to continue
                </p>
            </div>

            <div class="mb-3">

                <x-auth-session-status class="mb-4" :status="session('status')" />

                {{-- <div class="d-grid gap-2 mb-3">
                    <a class='btn btn-facebook btn-lg position-relative shadow' href='/dashboard-default'>
                        <i class="fab fa-fw fa-facebook fs-3 float-start"></i>
                        <span class="position-absolute mx-auto w-100 left-0">Continue with Facebook</span>
                    </a>
                    <a class='btn btn-google btn-lg position-relative shadow' href='/dashboard-default'>
                        <i class="fab fa-fw fa-google fa-google-colored fs-3  float-start"></i>
                        <span class="position-absolute mx-auto w-100 left-0">Continue with Google</span>
                    </a>
                    <a class='btn btn-apple btn-lg position-relative shadow' href='/dashboard-default'>
                        <i class="fab fa-fw fa-apple fs-3 float-start"></i>
                        <span class="position-absolute mx-auto w-100 left-0">Continue with Apple</span>
                    </a>
                </div>
                <div class="row">
                    <div class="col">
                        <hr>
                    </div>
                    <div class="col-auto text-uppercase d-flex align-items-center">Or</div>
                    <div class="col">
                        <hr>
                    </div>
                </div> --}}

                {{-- <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input class="form-control form-control-lg" placeholder="Enter your email" id="email"
                            type="email" name="email" :value="old('email')" required autofocus
                            autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input class="form-control form-control-lg mb-2" type="password" name="password"
                            placeholder="Enter your password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        <small>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    Forgot your password?
                                </a>
                            @endif
                        </small>
                    </div>
                    <div>
                        <div class="form-check align-items-center">
                            <input id="customControlInline" type="checkbox" class="form-check-input" value="remember-me"
                                name="remember-me">
                            <label class="form-check-label text-small" for="customControlInline">Remember me</label>
                        </div>
                    </div>
                    <div class="d-grid gap-2 mt-3">
                        <button class='btn btn-lg btn-primary text-lg' type="submit">Log in</button>
                    </div>
                </form> --}}
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email or Username</label>
                        <input class="form-control form-control-lg" placeholder="Enter your email or username"
                            id="identifier" type="text" name="identifier" :value="old('identifier')" required
                            autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('identifier')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input class="form-control form-control-lg mb-2" type="password" name="password"
                            placeholder="Enter your password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        <small>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    Forgot your password?
                                </a>
                            @endif
                        </small>
                    </div>
                    <div>
                        <div class="form-check align-items-center">
                            <input id="customControlInline" type="checkbox" class="form-check-input" value="remember-me"
                                name="remember" />
                            <label class="form-check-label text-small" for="customControlInline">Remember me</label>
                        </div>
                    </div>
                    <div class="d-grid gap-2 mt-3">
                        <button class='btn btn-lg btn-primary text-lg' type="submit">Log in</button>
                    </div>
                </form>

            </div>

            <div class="text-center">
                Don't have an account?
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Sign up</a>
                @endif
            </div>
        </div>
    </div>
</x-guest-layout>
