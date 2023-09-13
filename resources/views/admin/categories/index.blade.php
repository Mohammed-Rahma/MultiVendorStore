@extends('layouts.admin')

@section('content')


<div class="container-fluid d-flex justify-content-end row ">
    <a href="{{route('categories.create')}}" class="btn btn-outline-primary mr-4 mb-3"> Create</a>
    <a href="{{route('trashed')}}" class="btn btn-outline-danger mr-4 mb-3"> Trashed</a>
</div>
@if(session()->has('success'))
<div class="alert alert-success mt-2">{{ session()->get('success')}}</div>
@endif

<form action="{{URL::current()}}" method="get" class="form-inline">
    <x-form.input type="text" name="search" value="{{request('search')}}" class="from-control mr-2 mb-2" placeholder="Search..."/>

    <select name="parent_id" class="from-control mr-2 mb-2">
        <option>All Parents</option>
        @foreach($categories as $category)
        <option value="{{$category->parent_id}}" @selected(request('parent_id') == $category->id)> {{$category->name}}</option>
        @endforeach
    </select>

    <select name="status" class="from-control mr-2 mb-2">
        <option>Status</option>
       {{-- @foreach($status  as $value => $text)
        <option value="{{$value}}" @selected(request('status')==$value)>{{$text}}</option>
        @endforeach --}}
    </select>
    <x-form.input type="number" name="price_min" value="{{request('price_min')}}" class="mr-2 mb-2" placeholder="Min Price"/>
    <x-form.input type="number" name="price_max" value="{{request('price_max')}}" class="mr-2 mb-2" placeholder="Max Price"/>

    <button type="submit" class="btn btn-dark">Filter</button>
</form>

<dev class="container">
    <h2 class="mb-4 fs-3">{{$title}}</h2>
    <table class="table">
        <thead>
            <tr>

                <th>ID</th>
                <th>Image</th>
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
                <td>{{$category->id}}</td>
                <td>
                    <a href="{{$category->image_url}}" target="_blank">
                        <img src="{{$category->image_url}}" width="60" alt="">
                    </a>
                </td>
                <td>{{$category->name}}</td>
                <td>{{$category->parent_name}}</td>
                <td>{{$category->created_at}}</td>
                <td>{{$category->status}}</td>
                <td>
                    <a href="{{route('categories.edit' , $category->id)}}" class="btn btn-sm btn-outline-dark"><i class="fas fa-edit"></i></i> Edit</a>
                </td>
                <td>
                    <form action="{{route('categories.destroy' , $category->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-restore-alt"></i> Delete</button>
                    </form>
                </td>
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
