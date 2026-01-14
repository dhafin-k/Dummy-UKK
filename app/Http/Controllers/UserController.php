<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,petugas,owner',
        ]);

        try{
           $data = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'role' => $validated['role'],
                'password' => Hash::make($validated['password'])
           ]);

           return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
        } catch(\Exception $e) {
            return redirect()->route('admin.users.index')->with('error', 'Terjadi kesalahan saat menambahkan user.');
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
        $user = User::findOrFail($id);
        return view('admin.users.update', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,'.$id,
            'password' => 'sometimes|string|min:8',
            'role' => 'sometimes|in:admin,petugas,owner',
        ]);

        try {
            $data = User::findOrFail($id);
            $validated['password'] = isset($validated['password']) ? Hash::make($validated['password']) : $data->password;
            $data->update($validated);
            return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
        } catch(\Exception $e) {
            return redirect()->route('admin.users.index')->with('error', 'Terjadi kesalahan saat memperbarui user.');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
