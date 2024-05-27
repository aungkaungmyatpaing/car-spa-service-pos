<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);
        return view('backend.category.categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.category.create-category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        try {
            Category::create($request->validated());
            return redirect()->route('categories.index')->with('success', 'Category created successfully');
        } catch (\Throwable $th) {
            return redirect()->route('categories.create')->with('error', 'Category creation failed');
        }
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
        $category = Category::find($id);
        return view('backend.category.edit-category', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        try {
            $category = Category::find($id);
            $category->update($request->validated());
            return redirect()->route('categories.index')->with('success', 'Category updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Category update failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = Category::find($id);
            $services = $category->services;
            if ($services->count() > 0) {
                return redirect()->back()->with('error', 'Category has services, cannot delete');
            }
            $category->forceDelete();
            return redirect()->back()->with('success', 'Successfully delete category');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting category');
        }
    }
}
