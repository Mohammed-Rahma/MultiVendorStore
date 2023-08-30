@extends('layouts.admin')

@section('content')


<div class="container-fluid d-flex justify-content-end">
    <a href="{{route('categories.create')}}" class="btn btn-outline-primary mr-4 mb-3"> Create</a>
</div>
@if(session()->has('success'))
<div class="alert alert-success mt-2">{{ session()->get('success')}}</div>
@endif
<table class="table">
    <thead>
        <tr>
            <th>Image</th>
            <th>ID</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Created At</th>
            <th>Status</th>
            <th colspan="2"></th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $category)
        <tr>
            <td>
                <a href="{{$category->image_url}}" target="_blank">
                    <img src="{{$category->image_url}}" width="60" alt="">
                </a>
            </td>
            <td>{{$category->id}}</td>
            <td>{{$category->name}}</td>
            <td>{{$category->parent_id}}</td>
            <td>{{$category->created_at}}</td>
            <td>{{$category->status}}</td>
            <td>
                <a href="{{route('categories.edit' , $category->id)}}" class="btn btn-sm btn-outline-dark"><i class="fas fa-edit"></i></i> Edit</a>
            </td>
            <td>
                <form action="{{route('categories.destroy' , $category->id)}}" metdod="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <p style='color:red'>No Categories Found!</p>
        @endforelse

    </tbody>
</table>
<!-- table.table>thead>tr>th*4 -->
@endsection