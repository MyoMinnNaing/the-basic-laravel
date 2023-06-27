@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('content')
    <h2>I'm Dashboard page</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus ea, dignissimos a in possimus veritatis!
        Similique in quae sed, ullam, veniam, error labore corrupti magnam amet numquam dolorem consequatur modi.</p>

    <div class="alert alert-info">
        {{ session('auth')->name }}
    </div>

    <form action="{{ route('auth.logout') }}">

        <button class=" btn btn-primary">Logout</button>
    </form>
@endsection
