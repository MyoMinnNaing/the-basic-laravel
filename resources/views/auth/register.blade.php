@extends('layouts.master')

@section('title')
    Register Page
@endsection

@section('content')
    <h2 class=" text-primary">Register</h2>

    <form action="{{ route('auth.store') }}" method="post">

        @csrf

        <div class="mb-3">
            <label class=" form-label" for="">Your Name</label>
            <input type="text" value="{{ old('name') }}"
                class=" form-control @error('name')
                   is-invalid
                   @enderror"
                name="name">
            @error('name')
                <div class=" invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

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
            <label class=" form-label" for="">Confirm Password</label>
            <input type="password" class=" form-control @error('password_confirmation') is-invalid @enderror"
                name="password_confirmation">
            @error('password_confirmation')
                <div class=" invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <button class=" btn btn-primary">Register </button>
        </div>
    </form>
@endsection
