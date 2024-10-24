<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jabatan;
use App\Models\Detail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class AbsensiController extends Controller
{
    // Menampilkan daftar absensi
    public function index()
    {
        $user = Auth::user(); // Dapatkan user yang sedang login

        // Cek apakah user terautentikasi
        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Ambil absensi berdasarkan jabatan user
        $absensi = Absensi::where('id_jabatan', $user->id_jabatan)->with('detail')->get();

        $detail = Detail::all();

        // Temukan jabatan
        $jabatan = Jabatan::find($user->id_jabatan);
        if (!$jabatan) {
            return redirect()->back()->with('error', 'Jabatan tidak ditemukan.');
        }

        // Kembalikan tampilan dengan data yang diambil
        return view('user.absenkaryawan', compact('absensi', 'jabatan', 'detail'));
    }

    // Menyimpan data absensi baru
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'jabatan_id' => 'required|exists:jabatan,id',
            'kehadiran' => 'required|boolean',
            'tanggal_absen' => 'required|date',
            'foto_selfie' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate file type and size
            'lokasi' => 'required|string|max:255',
        ]);
    
        // Process the uploaded file
        if ($request->hasFile('foto_selfie')) {
            $file = $request->file('foto_selfie');
            $fileName = time() . '.' . $file->getClientOriginalExtension(); // Create a unique file name
            $file->move(public_path('uploads/foto_selfie'), $fileName); // Move the file to the specified location
    
            // Save data to the database
            // Assuming you have an Absensi model
            Absensi::create([
                'jabatan_id' => $request->jabatan_id,
                'kehadiran' => $request->kehadiran,
                'tanggal_absen' => $request->tanggal_absen,
                'foto_selfie' => 'uploads/foto_selfie/' . $fileName, // Save file path
                'lokasi' => $request->lokasi,
            ]);
        }
    
        return redirect()->route('absensi.index')->with('success', 'Data berhasil disimpan.');
    }
    

    // Menampilkan form untuk absensi
    public function showAbsensiForm()
    {
        $jabatanList = Jabatan::all(); // Ambil semua jabatan
        return view('absensi.form', compact('jabatanList')); // Kirim ke view
    }

    // Menampilkan detail absensi
    public function show($id)
    {
        $absensi = Absensi::with('detail', 'jabatan', 'user')->findOrFail($id);
        return view('absensi.show', compact('absensi'));
    }

    // Mengupdate data absensi
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_jabatan' => 'required|exists:jabatans,id_jabatan',
            'kehadiran_absen' => 'required|in:sakit,izin,hadir,alpa',
            'tanggal_absen' => 'required|date',
            'id_detail' => 'required|exists:details,id_detail', // Validasi id_detail
        ]);

        $absensi = Absensi::findOrFail($id);
        $absensi->update($validatedData);
        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil diupdate!');
    }

    // Menghapus data absensi
    public function destroy($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();
        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil dihapus!');
    }

    // Menambahkan kolom id_absensi di tabel details (migrasi)
    public function up()
    {
        Schema::table('details', function (Blueprint $table) {
            $table->unsignedBigInteger('id_absensi')->after('id')->nullable(); // Menambahkan kolom id_absensi
        });
    }

    // Menghapus kolom id_absensi jika rollback
    public function down()
    {
        Schema::table('details', function (Blueprint $table) {
            $table->dropColumn('id_absensi'); // Menghapus kolom id_absensi
        });
    }
}
