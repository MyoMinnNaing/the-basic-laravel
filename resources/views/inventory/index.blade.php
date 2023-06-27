@extends('layouts.master')

@section('title')
    Item List
@endsection

@section('content')
    @if (session('info'))
        <div class=" alert alert-success">
            {{ session('info') }}
        </div>
    @endif

    <h4>
        Item List

        @if (request()->has('keyword'))
            [Search result by {{ request()->keyword }} ]
        @endif
    </h4>

    <div class=" row ">
        <div class=" col-md-5 ms-auto my-4">
            <form action="{{ route('item.index') }}">
                <div class=" input-group">
                    <input type="text" @if (request()->has('keyword')) value = "{{ request()->keyword }}" @endif
                        class=" form-control" name="keyword">
                    @if (request()->has('keyword'))
                        <div>
                            {{-- <a href="{{ route('item.index') }}" class=" btn  btn-success "> x </a> --}}

                        </div>
                    @endif
                    <button class=" btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>

    <table class=" table">
        <thead>
            <tr>
                <td>#</td>
                <td>Name</td>
                <td>Price</td>
                <td>Stock</td>
                <td>Controls</td>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>
                        <a class=" btn btn-sm btn-outline-primary" href="{{ route('item.show', $item->id) }}">Detail</a>
                        <a class=" btn btn-sm btn-outline-warning" href="{{ route('item.edit', $item->id) }}">Edit</a>
                        <form class=" d-inline-block" action="{{ route('item.destroy', $item->id) }}" method="post">

                            @method('delete')
                            @csrf
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class=" text-center">
                        There is no record <br>
                        <a class=" btn btn-sm btn-primary" href="{{ route('item.create') }}">Create Item</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- {{$items->links()}} --}}
    {{ $items->onEachSide(1)->links() }}
@endsection
