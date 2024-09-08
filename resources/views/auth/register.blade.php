<x-guest-layout>
    <style>
        .form-control-sm-custom {
            font-size: 0.875rem;
            /* Adjust size as needed */
            padding: 0.375rem 0.75rem;
            /* Adjust padding as needed */
        }

        .form-floating-custom .form-control-sm-custom {
            font-size: 0.875rem;
            /* Adjust size as needed */
        }
    </style>

    <div class="auth-full-page d-flex">
        <div class="auth-form p-3">
            <div class="text-center">
                <h1 class="h2">Get started</h1>
                <p class="text-small">
                    Start creating the best possible user experience for your customers.
                </p>
            </div>

            <div class="mt-2">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row g-3">
                        <div class="col col-md-6">
                            <!-- First Name -->
                            <div class="form-floating mb-3">
                                <x-text-input id="firstname" class="form-control" type="text"
                                    name="firstname" required autofocus autocomplete="firstname"
                                    placeholder=" " />
                                <label for="firstname">{{ __('First Name') }}</label>
                                <x-input-error :messages="$errors->get('firstname')" class="form-text text-danger" />
                            </div>
                        </div>

                        <div class="col col-md-6">
                            <!-- Last Name -->
                            <div class="form-floating mb-3">
                                <x-text-input id="lastname" class="form-control" type="text"
                                    name="lastname" required autofocus autocomplete="lastname"
                                    placeholder=" " />
                                <label for="lastname">{{ __('Last Name') }}</label>
                                <x-input-error :messages="$errors->get('lastname')" class="form-text text-danger" />
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <!-- Username -->
                        <div class="col mb-3">
                            <div class="form-floating">
                                <x-text-input id="username" class="form-control" type="text" name="username" required autocomplete="username" placeholder=" " />
                                <label for="username">{{ __('Username') }}</label>
                                <x-input-error :messages="$errors->get('username')" class="form-text text-danger" />
                            </div>
                        </div>

                        <!-- Email Address -->
                        <div class="col mb-3">
                            <div class="form-floating">
                                <x-text-input id="email" class="form-control" type="email" name="email" required autocomplete="email" placeholder=" " />
                                <label for="email">{{ __('Email') }}</label>
                                <x-input-error :messages="$errors->get('email')" class="form-text text-danger" />
                            </div>
                        </div>
                    </div>

                    <!-- Gender, Mobile, and Birthdate Fields -->
                    <div class="col-md-12 mb-3">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <select id="gender" name="gender" class="form-select" required>
                                        <option value="">{{ __('Select Gender') }}</option>
                                        <option value="male">{{ __('Male') }}</option>
                                        <option value="female">{{ __('Female') }}</option>
                                    </select>
                                    <label for="gender">{{ __('Gender') }}</label>
                                    @if ($errors->has('gender'))
                                        <div class="form-text text-danger">{{ $errors->first('gender') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input id="mobile" name="mobile_num" type="tel" class="form-control"
                                        pattern="[0-9]{11}" placeholder=" " />
                                    <label for="mobile">{{ __('Mobile Number') }}</label>
                                    @if ($errors->has('mobile_num'))
                                        <div class="form-text text-danger">{{ $errors->first('mobile_num') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input id="birthdate" name="birthdate" type="date" class="form-control" required
                                        placeholder=" " />
                                    <label for="birthdate">{{ __('Birthdate') }}</label>
                                    @if ($errors->has('birthdate'))
                                        <div class="form-text text-danger">{{ $errors->first('birthdate') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-floating mb-3">
                        <x-text-input id="password" class="form-control" type="password" name="password" required
                            autocomplete="new-password" placeholder=" " />
                        <label for="password">{{ __('Password') }}</label>
                        <x-input-error :messages="$errors->get('password')" class="form-text text-danger" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-floating mb-3">
                        <x-text-input id="password_confirmation" class="form-control" type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder=" " />
                        <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="form-text text-danger" />
                    </div>

                    <div class="mt-3 small text-muted">
                        People who use our service may have uploaded your contact information to Facebook. <a
                            href="#">Learn more.</a><br><br>
                        By clicking Sign Up, you agree to our <a href="#" class="text-primary">Terms</a>, <a
                            href="#" class="text-primary">Privacy Policy</a> and <a href="#"
                            class="text-primary">Cookies Policy</a>. You may receive
                        SMS Notifications from us and can opt out any time.
                    </div>

                    <div class="mt-3">
                        <div class="d-grid gap-2">
                            <button type="submit" class='btn btn-lg btn-primary'>Sign up</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="text-center mt-3">
                Already have an account? <a href="{{ route('login') }}">Log In</a>
            </div>
        </div>
    </div>

    <script src="js/app.js"></script>
</x-guest-layout>
