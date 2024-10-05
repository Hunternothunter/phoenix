<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form> --}}

    {{-- <form method="post" action="{{ route('profile.update') }}" class="mt-4" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="row g-3">
            <p>{{ route('profile.update', $user->id) }}</p>
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
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label for="profile-image-file" class="form-label">{{ __('Profile Picture') }}</label>
                    <div class="text-center">
                        <img id="image-preview"
                            src="{{ old('profile_picture', $user->profile_picture ? asset('storage/profile_pictures/' . $user->profile_picture) : asset('storage/profile_pictures/default-user.png')) }}"
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
    </form> --}}


    {{-- <script>
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
    </script> --}}
    {{-- @vite(['resources/css/theme.min.css']) --}}

    <div class="content">
        <div class="mb-9">
            <div class="row g-6">
                <div class="col-12 col-xl-4">
                    <div class="card mb-5">
                        <div class="card-header hover-actions-trigger position-relative mb-6" style="min-height: 130px; ">
                            <div class="bg-holder rounded-top"
                                style="background-image: linear-gradient(0deg, #000000 -3%, rgba(0, 0, 0, 0) 83%), url(../../assets/img/generic/59.png)">
                                <input class="d-none" id="upload-settings-cover-image" type="file" />
                                <label class="cover-image-file-input" for="upload-settings-cover-image"></label>
                                <div class="hover-actions end-0 bottom-0 pe-1 pb-2 text-white dark__text-gray-1100">
                                    <span class="fa-solid fa-camera me-2"></span>
                                </div>
                            </div>
                            <input class="d-none" id="upload-settings-porfile-picture" type="file" />
                            <label class="avatar avatar-4xl status-online feed-avatar-profile cursor-pointer"
                                for="upload-settings-porfile-picture">
                                <img class="rounded-circle img-thumbnail shadow-sm border-0"
                                    src="{{ asset('storage/' . $user->profile_picture) }}" width="200" alt="" />
                            </label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex flex-wrap mb-2 align-items-center">
                                        <h3 class="me-2">{{ $user->firstname }} {{ $user->lastname }}</h3>
                                        <span class="fw-normal fs-8">u/{{ $user->username }}</span>
                                    </div>
                                    <div class="d-flex d-xl-block d-xxl-flex align-items-center">
                                        <div class="d-flex mb-xl-2 mb-xxl-0">
                                            <span class="fa-solid fa-user-group fs-10 me-2 me-lg-1 me-xl-2"></span>
                                            <h6 class="d-inline-block mb-0">
                                                {{ $user->followersCount() }}
                                                <span class="fw-semibold ms-1 me-4">Followers</span>
                                            </h6>
                                        </div>
                                        <div class="d-flex">
                                            <span class="fa-solid fa-user-check fs-10 me-2 me-lg-1 me-xl-2"></span>
                                            <h6 class="d-block d-xl-inline-block mb-0">
                                                {{ $user->followingCount() }}
                                                <span class="fw-semibold ms-1">Following</span>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pb-3 mb-4"> <!-- border-bottom border-translucent border-dashed -->
                        <h5 class="text-body mb-3">Who will be able to see your profile?</h5>
                        <div class="form-check">
                            <input class="form-check-input" id="onlyMe" type="radio" checked="checked"
                                name="profiileVisibility" />
                            <label class="form-check-label fs-8" for="onlyMe">Only me</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" id="myFollowers" type="radio" name="profiileVisibility" />
                            <label class="form-check-label fs-8" for="myFollowers">My followers</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" id="everyone" type="radio" name="profiileVisibility" />
                            <label class="form-check-label fs-8" for="everyone">Everyone</label>
                        </div>
                    </div>
                    <div class="pb-3 mb-4"> <!-- border-bottom border-translucent border-dashed -->
                        <h5 class="text-body mb-3">Who can tag you?</h5>
                        <div class="form-check">
                            <input class="form-check-input" id="tagGroupMembers" type="radio" checked="checked"
                                name="tagPermission" />
                            <label class="form-check-label fs-8" for="tagGroupMembers">Group Members</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" id="tagEveryone" type="radio" name="tagPermission" />
                            <label class="form-check-label fs-8" for="tagEveryone">Everyone</label>
                        </div>
                    </div>
                    <div class="pb-3 mb-4"> <!-- border-bottom border-translucent border-dashed -->
                        <div class="form-check">
                            <input class="form-check-input" id="showEmail" type="checkbox" name="showEmail" />
                            <label class="form-check-label fs-8" for="showEmail">Allow users to show your email</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" id="showExperiences" type="checkbox" name="showExperiences" />
                            <label class="form-check-label fs-8" for="showExperiences">Allow users to show your
                                experiences</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" id="showFollowers" type="checkbox" checked="checked"
                                name="showFollowers" />
                            <label class="form-check-label fs-8" for="showFollowers">Allow users to show your
                                followers</label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" id="showPhone" type="checkbox" checked="checked"
                                name="showPhone" />
                            <label class="form-check-label fs-8" for="showPhone">Show your phone number</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" id="permitFollow" type="checkbox" checked="checked"
                                name="permitFollow" />
                            <label class="form-check-label fs-8" for="permitFollow">Permit users to follow you.</label>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-8">
                    {{-- <div class="border-bottom mb-4"> --}}
                    <div class="mb-6">
                        <h4 class="mb-4">Personal Information</h4>
                        <div class="row g-3">
                            <div class="col-4 col-sm-4">
                                <div class="form-icon-container">
                                    <div class="form-floating">
                                        <input class="form-control form-icon-input" id="firstname" type="text"
                                            placeholder="First Name" value="{{ old('firstname', $user->firstname) }}" />
                                        <label class="text-body-tertiary form-icon-label" for="firstname">First Name</label>
                                    </div>
                                    <span class="fa-solid fa-user text-body fs-9 form-icon"></span>
                                </div>
                            </div>
                            <div class="col-4 col-sm-4">
                                <div class="form-icon-container">
                                    <div class="form-floating">
                                        <input class="form-control form-icon-input" id="middlename" type="text"
                                            placeholder="Middle Name" value="{{ old('middlename', $user->middlename) }}" />
                                        <label class="text-body-tertiary form-icon-label" for="middlename">Middle Name</label>
                                    </div>
                                    <span class="fa-solid fa-user text-body fs-9 form-icon"></span>
                                </div>
                            </div>
                            <div class="col-4 col-sm-4">
                                <div class="form-icon-container">
                                    <div class="form-floating">
                                        <input class="form-control form-icon-input" id="lastname" type="text"
                                            placeholder="Last Name" value="{{ old('lastname', $user->lastname) }}" />
                                        <label class="text-body-tertiary form-icon-label" for="lastname">Last Name</label>
                                    </div>
                                    <span class="fa-solid fa-user text-body fs-9 form-icon"></span>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-icon-container">
                                    <div class="form-floating">
                                        <input class="form-control form-icon-input" id="emailSocial" type="email"
                                            placeholder="Email" {{ old('email', $user->email) }} />
                                        <label class="text-body-tertiary form-icon-label" for="emailSocial">Email</label>
                                    </div>
                                    <span class="fa-solid fa-envelope text-body fs-9 form-icon"></span>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-icon-container">
                                    <div class="form-floating">
                                        <input class="form-control form-icon-input" id="mobile_num" type="tel"
                                            placeholder="Mobile Number" {{ old('mobile_num', $user->mobile_num) }} />
                                        <label class="text-body-tertiary form-icon-label" for="mobile_num">Mobile Number</label>
                                    </div>
                                    <span class="fa-solid fa-phone text-body fs-9 form-icon"></span>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-icon-container">
                                    <div class="form-floating">
                                        <textarea class="form-control form-icon-input" id="info" style="height: 115px;" {{ old('info', $user->info) }} placeholder="Info"></textarea>
                                        <label class="text-body-tertiary form-icon-label" for="info">Info</label>
                                    </div>
                                    <span class="fa-solid fa-circle-info text-body fs-9 form-icon"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row gx-3 mb-6 gy-6 gy-sm-3">
                        <div class="col-12 col-sm-6">
                            <h4 class="mb-4">Company Info</h4>
                            <div class="form-icon-container mb-3">
                                <div class="form-floating">
                                    <input class="form-control form-icon-input" id="companyName" type="text"
                                        placeholder="Company Name" />
                                    <label class="text-body-tertiary form-icon-label" for="companyName">COMPANY
                                        NAME</label>
                                </div>
                                <span class="fa-solid fa-building text-body fs-9 form-icon"></span>
                            </div>
                            <div class="form-icon-container">
                                <div class="form-floating">
                                    <input class="form-control form-icon-input" id="website" type="text"
                                        placeholder="Website" />
                                    <label class="text-body-tertiary form-icon-label" for="website">Website</label>
                                </div>
                                <span class="fa-solid fa-globe text-body fs-9 form-icon"></span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <h4 class="mb-4">Change Password</h4>
                            <div class="form-icon-container mb-3">
                                <div class="form-floating">
                                    <input class="form-control form-icon-input" id="oldPassword" type="password"
                                        placeholder="Old password" />
                                    <label class="text-body-tertiary form-icon-label" for="oldPassword">Old
                                        Password</label>
                                </div>
                                <span class="fa-solid fa-lock text-body fs-9 form-icon"></span>
                            </div>
                            <div class="form-icon-container mb-3">
                                <div class="form-floating">
                                    <input class="form-control form-icon-input" id="newPassword" type="password"
                                        placeholder="New password" />
                                    <label class="text-body-tertiary form-icon-label" for="newPassword">New
                                        Password</label>
                                </div>
                                <span class="fa-solid fa-key text-body fs-9 form-icon"></span>
                            </div>
                            <div class="form-icon-container">
                                <div class="form-floating">
                                    <input class="form-control form-icon-input" id="newPassword2" type="password"
                                        placeholder="Confirm New password" />
                                    <label class="text-body-tertiary form-icon-label" for="newPassword2">Confirm New
                                        Password</label>
                                </div>
                                <span class="fa-solid fa-key text-body fs-9 form-icon"></span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6">
                        <h4 class="mb-4">Social</h4>
                        <div class="row g-3">
                            <div class="col-12 col-sm-6">
                                <div class="form-icon-container">
                                    <div class="form-floating">
                                        <input class="form-control form-icon-input" id="facebook" type="text"
                                            placeholder="Facebook" />
                                        <label class="text-body-tertiary form-icon-label" for="facebook">Facebook</label>
                                    </div>
                                    <span class="fa-brands fa-facebook text-body fs-9 form-icon"></span>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-icon-container">
                                    <div class="form-floating">
                                        <input class="form-control form-icon-input" id="twitter" type="text"
                                            placeholder="Twitter" />
                                        <label class="text-body-tertiary form-icon-label" for="twitter">Twitter</label>
                                    </div>
                                    <span class="fa-brands fa-twitter text-body fs-9 form-icon"></span>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-icon-container">
                                    <div class="form-floating">
                                        <input class="form-control form-icon-input" id="linkedin" type="text"
                                            placeholder="Linkedin" />
                                        <label class="text-body-tertiary form-icon-label" for="linkedin">linkedin</label>
                                    </div>
                                    <span class="fa-brands fa-linkedin-in text-body fs-9 form-icon"></span>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-icon-container">
                                    <div class="form-floating">
                                        <input class="form-control form-icon-input" id="youtube" type="text"
                                            placeholder="youtube" />
                                        <label class="text-body-tertiary form-icon-label" for="youtube">youtube</label>
                                    </div>
                                    <span class="fa-brands fa-youtube text-body fs-9 form-icon"></span>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-icon-container">
                                    <div class="form-floating">
                                        <input class="form-control form-icon-input" id="artstation" type="text"
                                            placeholder="artstation" />
                                        <label class="text-body-tertiary form-icon-label"
                                            for="artstation">artstation</label>
                                    </div>
                                    <span class="fa-brands fa-artstation text-body fs-9 form-icon"></span>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-icon-container">
                                    <div class="form-floating">
                                        <input class="form-control form-icon-input" id="behance" type="text"
                                            placeholder="behance" />
                                        <label class="text-body-tertiary form-icon-label" for="behance">behance</label>
                                    </div>
                                    <span class="fa-brands fa-behance text-body fs-9 form-icon"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-end mb-6">
                        <div>
                            <button class="btn btn-phoenix-secondary me-2">Cancel Changes</button>
                            <button class="btn btn-phoenix-primary">Save Information</button>
                        </div>
                    </div>
                    {{-- </div> --}}
                    <div class="row gy-5">
                        <div class="col-12 col-md-6">
                            <h4 class="text-body-emphasis">Transfer Ownership</h4>
                            <p class="text-body-tertiary">Transfer this account to another person or to a company
                                repository.</p>
                            <button class="btn btn-phoenix-warning">Transfer</button>
                        </div>
                        <div class="col-12 col-md-6">
                            <h4 class="text-body-emphasis">Account Deletion</h4>
                            <p class="text-body-tertiary">Transfer this account to another person or to a company
                                repository.</p>
                            <button class="btn btn-phoenix-danger">Delete account</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
