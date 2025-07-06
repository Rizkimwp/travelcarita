<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        try {

            $query = User::query();

            // Jika ada pencarian, tambahkan filter
            if ($request->has('search')) {
                $query->where('name', 'like', '%'.$request->input('search').'%');
            }

            // Ambil limit per halaman (default 5)
            $perPage = $request->input('limit', 5);
            $perPage = in_array($perPage, [5, 10, 15]) ? $perPage : 5;

            // Gunakan paginate() agar pagination berfungsi dengan benar
            $users = $query->paginate($perPage);

            return view('admin.pages.user', compact('users'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengambil data.');
        }
    }

    public function store(Request $request)
    {

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits_between:10,15',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
        ]);

        try {

            User::create([
                'name' => $request->nama_lengkap,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'role' => $request->role,
            ]);

            return redirect()->back()->with('success', 'Registrasi berhasil!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat registrasi.'.$e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'required|digits_between:10,15',
            'role' => 'required|in:admin,user',
        ]);

        try {
            $user->update([
                'name' => $request->nama_lengkap,
                'email' => $request->email,
                'phone' => $request->phone,
                'role' => $request->role,
            ]);

            return redirect()->back()->with('success', 'Data user berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat update data. '.$e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->back()->with('success', 'Data user berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus user: '.$e->getMessage());
        }
    }
}
