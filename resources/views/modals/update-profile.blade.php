<x-modal name="whats-on-your-mind" maxWidth="lg" title="Update Profile Information" focusable>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="row g-3">
            <div class="col-md-9">
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input id="firstname" name="firstname" type="text" class="form-control"
                                value="{{ old('firstname', $user->firstname) }}" required autofocus
                                autocomplete="given-name" />
                            <label for="firstname">{{ __('First Name') }}</label>
                            @error('firstname')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input id="middlename" name="middlename" type="text" class="form-control"
                                value="{{ old('middlename', $user->middlename) }}" autocomplete="middle-name" />
                            <label for="middlename">{{ __('Middle Name') }}</label>
                            @error('middlename')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input id="lastname" name="lastname" type="text" class="form-control"
                                value="{{ old('lastname', $user->lastname) }}" required autocomplete="family-name" />
                            <label for="lastname">{{ __('Last Name') }}</label>
                            @error('lastname')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <div class="form-floating">
                            <select id="gender" name="gender" class="form-select" required>
                                <option value="">{{ __('Select Gender') }}</option>
                                <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>
                                    {{ __('Male') }}</option>
                                <option value="female"
                                    {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>
                                    {{ __('Female') }}</option>
                            </select>
                            <label for="gender">{{ __('Gender') }}</label>
                            @error('gender')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input id="mobile" name="mobile_num" type="tel" class="form-control"
                                value="{{ old('mobile_num', $user->mobile_num) }}" pattern="[0-9]{11}" />
                            <label for="mobile">{{ __('Mobile Number') }}</label>
                            @error('mobile_num')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input id="birthdate" name="birthdate" type="date" class="form-control"
                                value="{{ old('birthdate', $user->birthdate) }}" required />
                            <label for="birthdate">{{ __('Birthdate') }}</label>
                            @error('birthdate')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-floating">
                        <input id="email" name="email" type="email" class="form-control"
                            value="{{ old('email', $user->email) }}" required autocomplete="username" />
                        <label for="email">{{ __('Email') }}</label>
                        @error('email')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                            <div class="mt-3 text-muted">
                                {{ __('Your email address is unverified.') }}
                                <button form="send-verification" class="btn btn-link p-0 text-muted" type="submit">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 text-success">
                                        {{ __('A new verification link has been sent to your email address.') }}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label for="profile-image-file" class="form-label">{{ __('Profile Picture') }}</label>
                    <div class="text-center">
                        <img id="image-preview"
                            src="{{ old('profile_picture', $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('storage/profile_pictures/default-user.png')) }}"
                            alt="Profile picture" class="img-fluid rounded" style="max-width: 120px;" />
                    </div>
                    <input id="profile-image-file" name="profile_picture" type="file" class="d-none"
                        accept="image/*" onchange="previewImage(event)" />

                    <div class="text-center mt-3">
                        <a href="#" id="upload-button" class="btn btn-primary justify-content-center w-100"
                            onclick="document.getElementById('profile-image-file').click(); return false;">
                            <i class="align-middle me-1" data-lucide="upload"></i> {{ __('Upload Image') }}
                        </a>
                    </div>
                    @error('profile_picture')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center gap-3 mt-2">
            <button class="btn btn-light btn-lg w-100px">{{ __('Discard') }}</button>

            <button type="submit" class="btn btn-primary btn-lg w-100px">{{ __('Save') }}</button>
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
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '{{ asset('storage/profile_pictures/default-user.png') }}';
            }
        }
    </script>
</x-modal>
