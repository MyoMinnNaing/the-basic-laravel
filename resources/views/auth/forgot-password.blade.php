@extends('layouts.master')

@section('title')
    Forgot Password
@endsection

@section('content')
    <h5 class=" text-primary">Account registered လုပ်ခဲ့တုန်းက email ကိုပြန်ထည့်ပါ</h5>

    <form action="{{ route('auth.checkEmail') }}" method="post">

        @csrf

        <div class="mb-3">
            <label class=" form-label" for="">Enter Your Registered Email</label>
            <input type="email" class=" form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}">
            @error('email')
                <div class=" invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <button class=" btn btn-primary">Send Email </button>
        </div>
    </form>
@endsection
