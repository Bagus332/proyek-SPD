<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    //  Tampilkan halaman profil
    public function profile()
    {
        $user = Auth::user(); // Ambil data user yang login
        return view('profile.show', compact('user')); // Pastikan file view ada
    }

    //  Update data profil
    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        // Validasi sederhana (bisa dikembangkan)
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        // Update user
        $user->update($request->only('name', 'email'));

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    //  Deactivate akun user (optional)
    public function deactivate()
    {
        $user = Auth::user();

        // Contoh: set kolom status menjadi nonaktif
        $user->update(['status' => 'inactive']);

        Auth::logout();

        return redirect('/login')->with('success', 'Akun telah dinonaktifkan.');
    }
}
