@extends('layouts.master')

@section('title')
    Verify
@endsection

@section('content')
    <h2 class=" text-primary">Verify Email Here</h2>

    <form action="{{ route('auth.verifying') }}" method="post">

        @csrf

        <div class="mb-3">
            <label class=" form-label" for="">Verify Code</label>
            <input type="number" class=" form-control @error('verify_code') is-invalid @enderror" name="verify_code">
            @error('verify_code')
                <div class=" invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <button class=" btn btn-primary">Verify Email </button>
        </div>
    </form>
@endsection
