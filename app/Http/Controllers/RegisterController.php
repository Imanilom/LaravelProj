<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20', // Opsional, max 20 karakter
            'email' => 'required|string|email|unique:users|max:255', // Email wajib, unik, dan valid
            'password' => 'required|string|min:8|confirmed', // Password min 8 karakter, harus dikonfirmasi
        ]);

        // 2. Buat User Baru
        $user = User::create([
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'], // Menambahkan email ke data user
            'role' => 'user',
            'password' => Hash::make($validatedData['password']),
        ]);

        // 3. Login User (Opsional)
        // Jika ingin langsung login setelah registrasi, uncomment baris berikut:
        // Auth::login($user);

        // 4. Redirect (Sesuaikan dengan kebutuhan)
        return redirect('/user-management')->with('success', 'User berhasil didaftarkan!');
    }
}
