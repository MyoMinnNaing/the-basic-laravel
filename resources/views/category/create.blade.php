@extends("layouts.master")

@section('title')
    Create Category
@endsection

@section('content')

    <h4>Create Category</h4>
    {{-- @if ($errors->any())
        <ul class="text-danger">
             @foreach ($errors->all() as $error)
                 <li>{{$error}}</li>
             @endforeach
        </ul>

    @endif --}}

    <form action="{{route("category.store")}}" method="post">

        @csrf

        <div class="mb-3">
            <label class=" form-label" for="">Category Title</label>
            <input type="text" class=" form-control" name="title">
        </div>

        <div class="mb-3">
            <label class=" form-label" for="">Description</label>
            <textarea name="description" class=" form-control"  rows="7"></textarea>
        </div>



        <button class=" btn btn-primary">Save Category</button>
    </form>


@endsection
