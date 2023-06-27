@extends('layouts.master')

@section('title')
    Change Password
@endsection

@section('content')
    <h4 class=" fw-bold text-primary">Change Password</h4>



    <form action="{{ route('auth.passwordChanging') }}" method="post">

        @csrf

        <div class="mb-3">
            <label class=" form-label text-primary" for="">Old Password</label>
            <input type="password" class=" form-control @error('current_password') is-invalid @enderror"
                name="current_password">
            @error('current_password')
                <div class=" invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

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
            <button class=" btn btn-primary">Change Password </button>
        </div>
    </form>
@endsection
