@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p class="text-white text-2xl" >Welcome, {{ Auth::user()->name }}</p>
                        <form action="{{ route('logout') }}" method="post" class="flex items-center justify-center">
                            @csrf
                            <button type="submit" class="btn btn-primary bg-white mt-10 px-6 py-1 rounded-lg">{{ __('Logout') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
