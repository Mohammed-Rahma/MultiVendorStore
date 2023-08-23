<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $categories = Category::all();
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
    public function store(Request $request)
    {
        
          
   
        //Request merge 
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);
        $data =  $request->all();
        //request image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', 'public');     
          
            $data['image'] = $path;
        }


        Category::create($data);
        return redirect()->route('categories.index')->with('success','Category updated!');
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
    public function update(Request $request, string $id)
    {

        $categories = Category::findORfail($id);
        $data = $request->except('image');
        $old_image = $request->image;

        //request image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', [
                'disk'=> 'public'
            ]);
           
            $data['image'] = $path;
        }
        

        $categories->update($data);

        if($old_image && $old_image!=$categories->image){//$old_image && $old_image != $product->image
            
            Storage::disk('public')->delete($old_image);

            // Storage::disk('uploads')->delete($old_image);
        }


        return redirect()->route('categories.index')->with('success','Category updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categories = Category::findORfail($id);
        $categories->delete();
        return redirect()->route('categories.index')->with('success','Category deleted!');
    }
}
