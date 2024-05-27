<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCategories = SubCategory::orderBy('created_at', 'desc')->paginate(10);
        return view('backend.category.subCategory.index', compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.category.subCategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSubCategoryRequest $request)
    {
        try {
            SubCategory::create($request->validated());
            return redirect()->route('sub_categories.index')->with('success', 'Sub Category created successfully');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('sub_categories.create')->with('error', 'Sub Category creation failed');
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
        $categories = Category::all();
        $subCategory = SubCategory::find($id);
        return view('backend.category.subCategory.edit', compact('categories','subCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubCategoryRequest $request, string $id)
    {
        try {
            $subCategory = SubCategory::find($id);
            $subCategory->update($request->validated());
            return redirect()->route('sub_categories.index')->with('success', 'Sub Category updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Sub Category update failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $sub = SubCategory::find($id);
            $services = $sub->services;

            if ($services->count() > 0) {
                return redirect()->back()->with('error', 'Sub-Category has services, cannot delete');
            }
            $sub->forceDelete();
            return redirect()->back()->with('success', 'Successfully delete sub-category');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting sub-category');
        }
    }
}
