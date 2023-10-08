@extends('layouts.admin')

@section('content')

<dev class="container">
    <h2 class="mb-4 fs-3"></h2>
    <table class="table">
        <thead>
            <tr>

                <th>Products Name</th>
                <th>Parent</th>
                <th>Created At</th>
                <th>Status</th>
            </tr>
        </thead>
        @php
            $categories = $categories->products()->latest()->with('store')->paginate()
        @endphp
        <tbody>
            @forelse( $categories as $category)
            <tr>
                <td>{{$category->name}}</td>
                <td>{{$category->store->name}}</td>
                <td>{{$category->created_at}}</td>
                <td>{{$category->status}}</td>
            </tr>
            @empty
            <p style='color:red'>No Categories Found!</p>
            @endforelse

        </tbody>
    </table>
</dev>

{{$categories->withQueryString()->links()}}
<!-- table.table>thead>tr>th*4 -->
@endsection
