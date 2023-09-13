@extends('layouts.admin')

@section('content')
    <dev class="container">
        <h2 class="mb-4 fs-3">{{ $title }}</h2>
        <table class="table">
            <thead>
                <tr>

                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Parent</th>
                    <th>Delete At</th>
                    <th>Status</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>
                            <a href="{{ $category->image_url }}" target="_blank">
                                <img src="{{ $category->image_url }}" width="60" alt="">
                            </a>
                        </td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->parent_name }}</td>
                        <td>{{ $category->deleted_at }}</td>
                        <td>{{ $category->status }}</td>
                        <td>
                            <form action="{{route('restore' , $category->id)}}" method="post">
                                @csrf
                                @method('put')
                                <button class="btn btn-sm btn-primary"><i class="far fa-window-restore"></i> Restore</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('forceDelete', $category->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>
                                    Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <p style='color:red'>No Categories Found!</p>
                @endforelse

            </tbody>
        </table>
    </dev>

    {{ $categories->withQueryString()->links() }}
    <!-- table.table>thead>tr>th*4 -->
@endsection
