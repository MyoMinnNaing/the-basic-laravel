@extends('layouts.master')

@section('title')
    Reset Password
@endsection

@section('content')
    <h4 class=" fw-bold text-primary">To Reset Password</h4>

    <div class=" alert alert-info">
        {{ $user_token }}
    </div>

    <form action="{{ route('auth.resetPassword') }}" method="post">

        @csrf
        <input type="hidden" class=" form-control" name="user_token" value=" {{ $user_token }}">
        <div class="mb-3">
            <label class=" form-label text-primary" for="">New Password</label>
            <input type="password" class=" form-control @error('password') is-invalid @enderror" name="password">
            @error('password')
                <div class=" invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class=" form-label text-primary" for="">Comfirm New Password</label>
            <input type="password" class=" form-control @error('password_comfirmation') is-invalid @enderror"
                name="password_comfirmation">
            @error('password_comfirmation')
                <div class=" invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <button class=" btn btn-primary">Reset Password </button>
        </div>
    </form>
@endsection
