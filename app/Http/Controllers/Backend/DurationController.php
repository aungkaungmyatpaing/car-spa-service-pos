<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDurationRequest;
use App\Http\Requests\UpdateDurationRequest;
use App\Models\Duration;
use Illuminate\Http\Request;

class DurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $durations = Duration::orderBy('created_at', 'desc')->paginate(10);
        return view('backend.duration.index', compact('durations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.duration.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateDurationRequest $request)
    {
        try {
            Duration::create($request->validated());
            return redirect()->route('durations.index')->with('success', 'Duration created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create duration');
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
        $duration = Duration::find($id);
        return view('backend.duration.edit', compact('duration'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDurationRequest $request, string $id)
    {
        try {
            $duration = Duration::find($id);
            $duration->update($request->validated());
            return redirect()->route('durations.index')->with('success', 'Duration updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update duration');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $size = Duration::find($id);
            $services = $size->services;
            if ($services->count() > 0) {
                return redirect()->back()->with('error', 'Duration has services, cannot delete');
            }
            $size->delete();
            return redirect()->back()->with('success', 'Successfully delete duration');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting duration');
        }
    }
}
