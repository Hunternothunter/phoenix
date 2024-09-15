<x-modal name="whats-on-your-mind" maxWidth="lg" title="Update Profile Information" focusable>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    
    <form method="post" action="{{ route('profile.update') }}" class="mt-4" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="row g-3">
            <div class="col col-md-8">
                <div class="col-md-12 mb-3">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input id="firstname" name="firstname" type="text" class="form-control"
                                    value="{{ old('firstname', $user->firstname) }}" required autofocus
                                    autocomplete="given-name" />
                                <label for="firstname">{{ __('First Name') }}</label>
                                @if ($errors->has('firstname'))
                                    <div class="form-text text-danger">{{ $errors->first('firstname') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input id="middlename" name="middlename" type="text" class="form-control"
                                    value="{{ old('middlename', $user->middlename) }}" autocomplete="middle-name" />
                                <label for="middlename">{{ __('Middle Name') }}</label>
                                @if ($errors->has('middlename'))
                                    <div class="form-text text-danger">{{ $errors->first('middlename') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input id="lastname" name="lastname" type="text" class="form-control"
                                    value="{{ old('lastname', $user->lastname) }}" required
                                    autocomplete="family-name" />
                                <label for="lastname">{{ __('Last Name') }}</label>
                                @if ($errors->has('lastname'))
                                    <div class="form-text text-danger">{{ $errors->first('lastname') }}</div>
                                @endif
                            </div>
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
                                    <option value="male"
                                        {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>
                                        {{ __('Male') }}</option>
                                    <option value="female"
                                        {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>
                                        {{ __('Female') }}</option>
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
                                    value="{{ old('mobile_num', $user->mobile_num) }}" pattern="[0-9]{11}" />
                                <label for="mobile">{{ __('Mobile Number') }}</label>
                                @if ($errors->has('mobile_num'))
                                    <div class="form-text text-danger">{{ $errors->first('mobile_num') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input id="birthdate" name="birthdate" type="date" class="form-control"
                                    value="{{ old('birthdate', $user->birthdate) }}" required />
                                <label for="birthdate">{{ __('Birthdate') }}</label>
                                @if ($errors->has('birthdate'))
                                    <div class="form-text text-danger">{{ $errors->first('birthdate') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Email Field -->
                <div class="col-md-12 mb-3">
                    <div class="form-floating">
                        <input id="email" name="email" type="email" class="form-control"
                            value="{{ old('email', $user->email) }}" required autocomplete="username" />
                        <label for="email">{{ __('Email') }}</label>
                        @if ($errors->has('email'))
                            <div class="form-text text-danger">{{ $errors->first('email') }}</div>
                        @endif

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                            <div class="mt-3">
                                <p class="text-muted">
                                    {{ __('Your email address is unverified.') }}

                                    <button form="send-verification" class="btn btn-link p-0 text-muted" type="submit">
                                        {{ __('Click here to re-send the verification email.') }}
                                    </button>
                                </p>

                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 text-success">
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col col-md-4">
                <!-- Profile Image and Preview -->
                <div class="col-md-12 mb-3">
                    <label for="profile-image-file" class="form-label">{{ __('Profile Picture') }}</label>
                    <div class="mt-2 text-center">
                        <div class="image-container">
                            <img id="image-preview"
                                src="{{ old('profile_picture', $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('storage/profile_pictures/default-user.png')) }}"
                                alt="Profile picture" class="img-fluid" />
                        </div>
                    </div>

                    <!-- Hidden file input -->
                    <input id="profile-image-file" name="profile_picture" type="file" class="d-none"
                        accept="image/*" onchange="previewImage(event)" />

                    <!-- Styled link acting as file upload button -->
                    <div class="text-center mt-3">
                        <a href="#" id="upload-button" class="btn btn-primary w-90 max-height-100"
                            onclick="document.getElementById('profile-image-file').click(); return false;">
                            <i class="align-middle me-1" data-lucide="upload"></i>
                            {{ __('Upload Image') }}
                        </a>
                    </div>

                    @if ($errors->has('profile_picture'))
                        <div class="form-text text-danger">{{ $errors->first('profile_picture') }}</div>
                    @endif
                </div>
            </div>

            <!-- Address Fields -->
            {{-- <div class="col-md-8 mb-3">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input id="street_address" name="street_address" type="text" class="form-control"
                                value="{{ old('street_address', $user->street_address) }}" />
                            <label for="street_address">{{ __('Street Address') }}</label>
                            @if ($errors->has('street_address'))
                                <div class="form-text text-danger">{{ $errors->first('street_address') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input id="city" name="city" type="text" class="form-control"
                                value="{{ old('city', $user->city) }}" />
                            <label for="city">{{ __('City') }}</label>
                            @if ($errors->has('city'))
                                <div class="form-text text-danger">{{ $errors->first('city') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input id="state" name="state" type="text" class="form-control"
                                value="{{ old('state', $user->state) }}" />
                            <label for="state">{{ __('State') }}</label>
                            @if ($errors->has('state'))
                                <div class="form-text text-danger">{{ $errors->first('state') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input id="zip" name="zip" type="text" class="form-control"
                                value="{{ old('zip', $user->zip) }}" />
                            <label for="zip">{{ __('Zip Code') }}</label>
                            @if ($errors->has('zip'))
                                <div class="form-text text-danger">{{ $errors->first('zip') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input id="occupation" name="occupation" type="text" class="form-control"
                                value="{{ old('occupation', $user->occupation) }}" />
                            <label for="occupation">{{ __('Occupation') }}</label>
                            @if ($errors->has('occupation'))
                                <div class="form-text text-danger">{{ $errors->first('occupation') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input id="nationality" name="nationality" type="text" class="form-control"
                                value="{{ old('nationality', $user->nationality) }}" />
                            <label for="nationality">{{ __('Nationality') }}</label>
                            @if ($errors->has('nationality'))
                                <div class="form-text text-danger">{{ $errors->first('nationality') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- Occupation, Nationality, and Bio Fields -->
            {{-- <div class="col-md-8 mb-3">
                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea id="bio" name="bio" class="form-control" rows="3">{{ old('bio', $user->bio) }}</textarea>
                            <label for="bio">{{ __('Bio') }}</label>
                            @if ($errors->has('bio'))
                                <div class="form-text text-danger">{{ $errors->first('bio') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- Preferred Contact Method -->
            {{-- <div class="col-md-4 mb-3">
                <div class="form-floating">
                    <select id="preferred_contact" name="preferred_contact" class="form-select" required>
                        <option value="">{{ __('Select Contact Method') }}</option>
                        <option value="email"
                            {{ old('preferred_contact', $user->preferred_contact) == 'email' ? 'selected' : '' }}>
                            {{ __('Email') }}</option>
                        <option value="phone"
                            {{ old('preferred_contact', $user->preferred_contact) == 'phone' ? 'selected' : '' }}>
                            {{ __('Phone') }}</option>
                    </select>
                    <label for="preferred_contact">{{ __('Preferred Contact Method') }}</label>
                    @if ($errors->has('preferred_contact'))
                        <div class="form-text text-danger">{{ $errors->first('preferred_contact') }}</div>
                    @endif
                </div>
            </div> --}}
        </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-muted mb-0">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
    <script>
        function previewImage(event) {
            const input = event.target;
            const file = input.files[0];
            const preview = document.getElementById('image-preview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    console.log('Image preview updated');
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
            }
        }
    </script>
</x-modal>
