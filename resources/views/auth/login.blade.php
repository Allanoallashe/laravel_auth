@extends('layouts.app')

@section('content')
<div class="container bg-slate-300 w-full py-3 px-3 rounded-lg">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center font-bold">{{ __('Login') }}</div>

                <div class="card-body">
                    <form id="loginForm" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row flex-col">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6 ">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror w-full rounded-lg outline-emerald-900" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row flex-col ">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror w-full rounded-lg outline-emerald-900" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="use_fingerprint" id="use_fingerprint">

                                    <label class="form-check-label" for="use_fingerprint">
                                        {{ __('Use Fingerprint') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4 flex items-center flex-col">
                                <button type="submit" class="btn btn-primary bg-slate-400 w-36 py-1  rounded-lg mt-2 mb-2">
                                    {{ __('Login') }}
                                </button>

                                <a href="{{ route('register') }}" class="btn btn-link underline-offset-2 text-green">{{ __('Don\'t have an account? Register') }}</a>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/fingerprintjs2/2.1.0/fingerprint2.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const loginForm = document.getElementById('loginForm');
        const useFingerprintCheckbox = document.getElementById('use_fingerprint');

        useFingerprintCheckbox.addEventListener('change', function () {
            if (this.checked) {
                // Use fingerprint authentication
                Fingerprint2.get(function (components) {
                    // Send fingerprint data to the server
                    const fingerprint = Fingerprint2.x64hash128(components.map(function (pair) {
                        return pair.value;
                    }).join(), 31);

                    // Append fingerprint data to the form
                    const fingerprintField = document.createElement('input');
                    fingerprintField.type = 'hidden';
                    fingerprintField.name = 'fingerprint';
                    fingerprintField.value = fingerprint;
                    loginForm.appendChild(fingerprintField);
                });
            } else {
                // Remove fingerprint data if unchecked
                const fingerprintField = loginForm.querySelector('input[name="fingerprint"]');
                if (fingerprintField) {
                    fingerprintField.remove();
                }
            }
        });
    });
</script>
@endpush
