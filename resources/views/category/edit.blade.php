@extends('layouts.master')

@section('title')
    Update Category
@endsection

@section('content')
    <h4>Update Category</h4>

    {{-- @if ($errors->any())
        <ul class="text-danger">
             @foreach ($errors->all() as $error)
                 <li>{{$error}}</li>
             @endforeach
        </ul>

    @endif --}}



    <form action="{{ route('category.update', $category->id) }}" method="post">
        @method('put')
        @csrf

        <div class="mb-3">
            <label class=" form-label" for="">Category Title</label>
            <input type="text" class=" form-control" value="{{ $category->title }}" name="title">
        </div>

        <div class="mb-3">
            <label class=" form-label" for="">Description</label>
            <textarea name="description" class=" form-control" rows="7">value="{{ $category->description }}"</textarea>
        </div>

        <button class=" btn btn-primary">Update Category</button>
    </form>
@endsection
