<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CrudKaryawanController extends Controller
{
    // Menampilkan semua karyawan
    public function index()
    {
        $karyawan = User::all(); // Ambil semua data karyawan
        return view('admin/crudkaryawan', compact('karyawan'));
    }

    // Menampilkan form untuk menambah karyawan baru
    public function create()
    {
        return view('admin/crudkaryawan.create',compact('jabatan'));
    }

    // Menyimpan karyawan baru
    
   
public function store(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required',
        'role' => 'required',
        'jabatan' => 'required',
    ]);

    User::create([
        'username' => $request->username,
        'password' => $request->password,
        'role' => $request->role,
        'id_jabatan' => $request->jabatan, // Menyimpan id jabatan
    ]);

    return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan');
    }
    public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'username' => 'required',
        'role' => 'required'
    ]);

    // Ambil data karyawan yang akan diupdate
    $karyawan = User::findOrFail($id);

    // Update username dan role
    $karyawan->username = $request->username;
    $karyawan->role = $request->role;

    // Jika password tidak kosong, update password
    if (!empty($request->password)) {
        $karyawan->password = md5($request->password); // Gunakan md5 untuk encrypt password
    }

    $karyawan->save(); // Simpan perubahan

    return redirect()->back()->with('success', 'Karyawan berhasil diupdate!');
}


    // Menampilkan form untuk edit karyawan
    public function edit($id)
    {
        $karyawan = User::findOrFail($id); // Ambil data karyawan berdasarkan ID
        $jabatans = Jabatan::all(); // Ambil semua data jabatan
        return view('admin.crudkaryawan.edit', compact('karyawan', 'jabatans')); // Kirim variabel ke view
    }

    

    
    // Menghapus karyawan
    public function destroy($id)
    {
        $karyawan = User::findOrFail($id);
        $karyawan->delete(); // Hapus karyawan
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus');
    }
}
