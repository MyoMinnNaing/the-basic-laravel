@extends("layouts.master")

@section('title')
    Create Item
@endsection

@section('content')

    <h4>Create Item</h4>
    {{-- @if ($errors->any())
        <ul class="text-danger">
             @foreach ($errors->all() as $error)
                 <li>{{$error}}</li>
             @endforeach
        </ul>

    @endif --}}

    <form action="{{route("item.store")}}" method="post">

        @csrf

        <div class="mb-3">
            <label class=" form-label" for="">Item Name</label>
            <input type="text"
                  value="{{old("name")}}"
                   class=" form-control @error('name')
                   is-invalid
                   @enderror" name="name">
            @error('name')
                <div class=" invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class=" form-label" for="">Item Price</label>
            <input type="number"
                     value="{{old("price")}}"
                    class=" form-control @error('price')
                    is-invalid
                     @enderror" name="price">
            @error('price')
                <div class=" invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class=" form-label" for="">Stock</label>
            <input type="number"  value="{{old("stock")}}" class=" form-control @error('stock')
                is-invalid
            @enderror" name="stock">
            @error('stock')
                <div class=" invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <button class=" btn btn-primary">Save Item</button>
    </form>


@endsection
