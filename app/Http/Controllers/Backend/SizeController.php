<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSizeRequest;
use App\Http\Requests\UpdateSizeRequest;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sizes = Size::orderBy('created_at', 'desc')->paginate(10);
        return view('backend.size.sizes', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.size.create-size');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSizeRequest $request)
    {
        try {
            Size::create($request->validated());
            return redirect()->route('sizes.index')->with('success', 'Size created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create size');
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
        $size = Size::find($id);
        return view('backend.size.edit-size', compact('size'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSizeRequest $request, string $id)
    {
        try {
            $size = Size::find($id);
            $size->update($request->validated());
            return redirect()->route('sizes.index')->with('success', 'Size updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update size');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $size = Size::find($id);
            $services = $size->services;
            if ($services->count() > 0) {
                return redirect()->back()->with('error', 'Size has services, cannot delete');
            }
            $size->delete();
            return redirect()->back()->with('success', 'Successfully delete size');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting size');
        }
    }
}
