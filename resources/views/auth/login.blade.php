@extends('layouts.master')

@section('title')
    Login Page
@endsection

@section('content')
    <h2>I'm Login page</h2>
    @if (session('message'))
        <div class="alert alert-primary">
            {{ session('message') }}
        </div>
    @endif

    @if (session('link'))
        <div class="">
            <a href="{{ session('link') }}" class=" btn btn-link">Click here to reset password</a>
        </div>
    @endif


    <form action="{{ route('auth.check') }}" method="post">

        @csrf

        <div class="mb-3">
            <label class=" form-label" for="">Email</label>
            <input type="email" value="{{ old('email') }}"
                class=" form-control @error('email')
                    is-invalid
                     @enderror"
                name="email">
            @error('email')
                <div class=" invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class=" form-label" for="">Password</label>
            <input type="password" class=" form-control @error('password') is-invalid @enderror" name="password">
            @error('password')
                <div class=" invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <button class=" btn btn-primary">Login </button>
            <a href="{{ route('auth.forgotPassword') }}" class=" btn btn-link fw-bold">Forgot Password</a>
        </div>
    </form>
@endsection
