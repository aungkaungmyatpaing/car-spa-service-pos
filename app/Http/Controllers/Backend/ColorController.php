<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateColorRequest;
use App\Http\Requests\UpdateColorRequest;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colors = Color::orderBy('created_at', 'desc')->paginate(10);
        return view('backend.color.colors', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.color.create-color');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateColorRequest $request)
    {
        try {
            Color::create($request->validated());
            return redirect()->route('colors.index')->with('success', 'Color created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create color');
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
        $color = Color::find($id);
        return view('backend.color.edit-color', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateColorRequest $request, string $id)
    {
        try {
            $color = Color::find($id);
            $color->update($request->validated());
            return redirect()->route('colors.index')->with('success', 'Color updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update color');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $color = Color::find($id);
            $products = $color->products;
            if ($products->count() > 0) {
                return redirect()->back()->with('error', 'Color has products, cannot delete');
            }
            $color->delete();
            return redirect()->back()->with('success', 'Successfully delete color');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting color');
        }
    }
}
