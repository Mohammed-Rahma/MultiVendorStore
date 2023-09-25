<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::with(['category' , 'store'])->paginate(7);
        return view(
            'admin.products.index',
            [
                'products' => $products,
                'title' => 'Products List'
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $products = Product::findorfail($id);

        return view('admin.products.edit', [
            'products' => $products,
            'status_option' => [
                'active' => 'Active',
                'archived' => 'Archived'
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('categories.index')->with('success', "product {($product->name)} deleted!");
    }
    public function trashed()
    {
        $products = product::onlyTrashed()->paginate();

        return view(
            'admin.products.trashed',
            [
                'products' => $products,
                'title' => 'Trashed List'
            ]
        );
    }

    public function forceDelete(string $id)
    {
        $product = product::onlyTrashed()->findorfail($id);
        $product->forceDelete();
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        return redirect()->route('categories.index')->with('success', "product {($product->name)} deleted");
    }

    public function restore(string $id)
    {
        $product = product::onlyTrashed()->findorfail($id);
        $product->restore();
        return redirect()->route('categories.index')->with('success', "product {($product->name)} deleted");
    }
}
