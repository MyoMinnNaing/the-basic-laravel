@extends("layouts.master")

@section('title')
    Category List
@endsection

@section('content')

    <h4>Category List</h4>

    <table class=" table">
        <thead>
            <tr>
                <td>#</td>
                <td>Title</td>
                <td>Description</td>
                <td>Controls</td>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{Str::limit($category->title ,15,"....")}}</td>
                    <td>{{Str::limit($category->description ,50,"....")}}</td>
                    <td>
                         <a class=" btn btn-sm btn-outline-primary" href="{{route("category.show",$category->id)}}" >Detail</a>
                         <a class=" btn btn-sm btn-outline-warning" href="{{route("category.edit",$category->id)}}" >Edit</a>
                         <form class=" d-inline-block" action="{{route("category.destroy",$category->id)}}" method="post">

                            @method("delete")
                            @csrf
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class=" text-center">
                        There is no record <br>
                        <a class=" btn btn-sm btn-primary mt-2" href="{{ route('category.create') }}">Create Category</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- {{$categories->links()}} --}}
    {{$categories->onEachSide(1)->links()}}


@endsection
