<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('backend.user.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.user.create-user');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $user = User::create($request->validated());
        if (isset($request->validated()['image'])) {
            $image = $request->validated()['image'];
            $filename = FileHelper::generateUniqueFilename($image);
            $user->clearMediaCollection('avatar');
            $user->addMedia($image)
                ->usingFileName($filename)
                ->toMediaCollection('avatar');
        }
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('backend.user.edit-user', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->validated());
        if (isset($request->validated()['image'])) {
            $image = $request->validated()['image'];
            $filename = FileHelper::generateUniqueFilename($image);
            $user->clearMediaCollection('avatar');
            $user->addMedia($image)
                ->usingFileName($filename)
                ->toMediaCollection('avatar');
        }
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if ($user->invoice->count() > 0) {
            return redirect()->route('users.index')->with('error', 'User has invoices, cannot delete');
        }
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
