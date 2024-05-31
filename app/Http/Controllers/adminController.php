<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Schema;


class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addUserForm()
    {
        return view('admin/add-user');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'role' => 'required',
            'name' => 'required',
            'password' => 'required|min:6', // Contoh validasi password minimal 6 karakter
            'phone' => 'nullable',
            'location' => 'nullable',
            'about_me' => 'nullable',
        ]);

        User::create($validatedData); // Langsung membuat user dengan data tervalidasi

        return redirect('/user-management')->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $users = User::all();
        return view('admin/user-management', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editUser(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin/edit-user', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'role' => 'required',
            'name' => 'required',
            'password' => 'nullable|min:6', // Password boleh kosong jika tidak diubah
            'phone' => 'nullable',
            'location' => 'nullable',
            'about_me' => 'nullable',
        ]);

        // Update password hanya jika ada inputan baru
        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        }

        $user->update($validatedData);

        return redirect('/user-management')->with('success', 'User berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/user-management');
    }
}
