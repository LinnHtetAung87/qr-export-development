<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>


    <form method="post" action="{{ route('admin.profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">

    <form method="post" action="{{ route('admin.profile.update') }}" class="mt-6 space-y-6">

        @csrf
        @method('patch')

        <div class="mb-3">

            <div class="row justify-content-center">
                <div class="col-md-3 text-center">
                    <div class="fileinput fileinput-new text-center mt-4" data-provides="fileinput">

                        @if (!($user->profile_image == null || $user->profile_image == ''))
                            <div class="fileinput-new thumbnail shadow">
                                <img src="{{URL::asset( $user->profile_image)}}" alt="Profile Image" id="profile_image_update">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail" style=""></div>
                            <div>
                                <span class="btn btn-secondary btn-round btn-file">
                                    <span class="fileinput-new" style="display: none;">Profile Image</span>
                                    <span class="fileinput-exists" style="display: block;">Change</span>
                                    <input type="file" id="profile_image" name="profile_image" value=""
                                        accept="image/*">
                                    <input type="hidden" name="old_profile_image" id="old_profile_image"
                                        value="{{ $user->profile_image }}">
                                </span>
                                <a href="{{ route('admin.remove_profile_photo',$user->id) }}" onclick="return confirm('Are you sure want to remove profile photo?')" class="btn btn-danger btn-round fileinput-exists" style="display: inline;"
                                    ><i class="fa fa-times"></i> Remove</a>
                            </div>
                        @else
                            <div class="fileinput-new thumbnail shadow">
                                <img src="{{URL::asset('/admin/dist/img/default-profile-image.png')}}" alt="Profile Image" id="profile_image_update">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail" style=""></div>
                            <div>
                                <span class="btn btn-secondary btn-round btn-file">
                                    <span class="fileinput-new" style="display: block;">Profile Image</span>
                                    <span class="fileinput-exists" style="display: none;">Change</span>
                                    <input type="file" id="profile_image" name="profile_image" value=""
                                        accept="image/*">
                                    <input type="hidden" name="old_profile_image" id="old_profile_image"
                                        value="{{ $user->profile_image }}">
                                </span>
                                <a href="{{ route('admin.remove_profile_photo',$user->id) }}" onclick="return confirm('Are you sure want to remove profile photo?')" class="btn btn-danger btn-round fileinput-exists"
                                    ><i class="fa fa-times"></i> Remove</a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">


            <x-input-label for="name" class="form-label" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name', $user->name)" required
                autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div class="mb-3">
            <x-input-label for="Mode" class="form-label" :value="__('Mode')" />
            <select name="mode" id="Mode" class="form-control">
                <option {{ Auth::user()->mode == 'dark' ? 'selected' : '' }} value="dark">Dark</option>
                <option {{ Auth::user()->mode == 'light' ? 'selected' : '' }} value="light">Light</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('mode')" />
        </div>
        <div class="mb-3">
            <x-input-label for="email" class="form-label" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="form-control" :value="old('email', $user->email)" required
                autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center pb-4">
            <button type="submit" class="btn btn-primary btn-sm mb-3">{{ __('Save') }}</button>
            @if (session('status') === 'profile-updated')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ 'Saved' }}
                    <button type="button" class="btn btn-sm float-end float-right" data-bs-dismiss="alert"
                        aria-label="Close">&times;</button>
                </div>
            @endif
        </div>
    </form>
</section>
