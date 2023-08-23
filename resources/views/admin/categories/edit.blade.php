@extends('layouts.admin')

@section('content')

<form action="{{route('categories.update' , $categories->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    @include('admin.categories._form' , ['button'=>'Edit'])
</form>
@endsection 