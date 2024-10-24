<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Jabatan; // Don't forget to import the model

class CrudjadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::all(); // Retrieve all jadwals
        $jabatans = Jabatan::all(); // Retrieve all jabatans

        return view('admin.crudjadwal', compact('jadwals', 'jabatans')); // Pass both variables to the view
    }

    public function create()
    {
        $jabatans = Jabatan::all(); // Retrieve all jabatans

        return view('admin.crudjadwal.create', compact('jabatans')); // If you have a separate create view
    }

    public function store(Request $request)
    {
        // Validate your request here if needed

        $jadwal = new Jadwal;
        $jadwal->jadwal_hadir = $request->jadwal_hadir;
        $jadwal->jadwal_pulang = $request->jadwal_pulang;
        $jadwal->id_jabatan = $request->id_jabatan;
        $jadwal->save();

        return redirect()->route('crudjadwal.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jabatans = Jabatan::all(); // Retrieve all jabatans

        return view('admin.crudjadwal.edit', compact('jadwal', 'jabatans'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->jadwal_hadir = $request->jadwal_hadir;
        $jadwal->jadwal_pulang = $request->jadwal_pulang;
        $jadwal->id_jabatan = $request->id_jabatan;
        $jadwal->save();

        return redirect()->route('crudjadwal.index')->with('success', 'Jadwal berhasil diupdate!');
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('crudjadwal.index')->with('success', 'Jadwal berhasil dihapus!');
    }
}
