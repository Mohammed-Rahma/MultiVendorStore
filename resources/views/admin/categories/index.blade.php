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
            <th><img src="{{asset('storage/' .$categories->image)}}" alt="" height="50"></th>
            <th>{{$category->id}}</th>
            <th>{{$category->name}}</th>
            <th>{{$category->parent_id}}</th>
            <th>{{$category->created_at}}</th>
            <th>{{$category->status}}</th>
            <th>
                <a href="{{route('categories.edit' , $category->id)}}"  class="btn btn-sm btn-outline-dark"><i class="fas fa-edit"></i></i> Edit</a>
            </th>
            <th>
                <form action="{{route('categories.destroy' , $category->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger" ><i class="fas fa-trash-alt"></i>  Delete</button>
                </form>
            </th>
        </tr>
        @empty
        <p style='color:red'>No Categories Found!</p>
        @endforelse

    </tbody>
</table>
<!-- table.table>thead>tr>th*4 -->
@endsection