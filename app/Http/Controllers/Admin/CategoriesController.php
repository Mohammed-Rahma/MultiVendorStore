<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(2);
        return view('admin.Categories.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = new Category();
        $parents = Category::all();
        return view('admin.Categories.create', [
            'categories' => $categories,
            'parents' => $parents,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated;

        //Request merge 
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);
        $data =  $request->all();
        //request image
        $data['image'] = $this->uploadImage($request);

        Category::create($data);
        return redirect()->route('categories.index')->with('success', 'Category updated!');
        //prg post redirect get 
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


        try {
            $categories = Category::findorfail($id);
        } catch (Exception $e) {
            return view('admin.categories.error');
        }

        $parents = Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')
                    ->ORwhere('parent_id', '<>', $id);
            })->get();
        return view('admin.categories.edit', [
            'categories' => $categories,
            'parents' => $parents
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        //validation 
        $data = $request->validated;

        $categories = Category::findORfail($id);
        $data = $request->except('image');
        $old_image = $request->image;

        //request image
        $data['image'] = $this->uploadImage($request);

        $categories->update($data);

        if ($old_image && $data['image']) { //$old_image && $old_image != $product->image

            Storage::disk('public')->delete($old_image);

            // Storage::disk('uploads')->delete($old_image);
        }


        return redirect()->route('categories.index')->with('success', 'Category updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categories = Category::findORfail($id);
        $categories->delete();
        if ($categories->image) {
            Storage::disk('public')->delete($categories->image);
        }
        return redirect()->route('categories.index')->with('success', 'Category deleted!');
    }

    public function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image');
        // $file->getClientOriginalName();
        $path = $file->store('uploads', ['disk' => 'public']);
        return $path;
    }
}
