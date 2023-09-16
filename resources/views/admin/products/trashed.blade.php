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
                    <th>Store</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Compare Price</th>
                    <th>Featured</th>
                    <th colspan="2"></th>

                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            <a href="{{ $product->image_url }}" target="_blank">
                                <img src="{{ $product->image_url }}" width="60" alt="">
                            </a>
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->store_id }}</td>
                        <td>{{ $product->category_id }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->compare_price }}</td>
                        <td>{{ $product->featured }}</td>

                        <td>
                            <form action="{{ route('products.restore', $product->id) }}" method="post">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-sm btn-danger"><i
                                        class="fas fa-trash-restore-alt"></i> Restore</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger"><i
                                        class="fas fa-trash-restore-alt"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <p style='color:red'>No products Found!</p>
                @endforelse

            </tbody>
        </table>
    </dev>

    {{ $products->withQueryString()->links() }}
    <!-- table.table>thead>tr>th*4 -->
@endsection
