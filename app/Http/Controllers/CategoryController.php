<?php

namespace App\Http\Controllers;

use App\Models\users\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        try {
            $data = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name',
            ]);
            Category::create([
                'name' => $request['name']
            ]);
            alert()->success('Category', 'Category added successfully');
        } catch (\Exception $e) {
            Alert::error('Category', 'Failed to add category');
        }
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        $id = $category->id;
        return view('admin.category.update', compact('id', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name',

            ]);
            $category->update($data);
            alert()->success('Category', 'Category updated successfully');
        } catch (\Exception $e) {
            Alert::error('Category', 'Failed to update category');
        }

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        try {
            $category->delete();
            alert()->success('Category', 'Category deleted successfully');
        } catch (\Exception $e) {
            Alert::error('Category', 'Failed to delete category');
        }
        return redirect()->route('category.index');
    }
}
