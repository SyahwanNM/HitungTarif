<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kota;
use App\Models\Kriteria;
use App\Models\Bobot;
use App\Models\HasilPerhitungan;
use App\Models\TarifRekomendasi;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Menampilkan dashboard admin
     */
    public function dashboard()
    {
        $totalKota = Kota::count();
        $totalPerhitungan = HasilPerhitungan::count();
        $totalPerbandingan = TarifRekomendasi::count();
        
        return view('admin.dashboard', compact('totalKota', 'totalPerhitungan', 'totalPerbandingan'));
    }

    /**
     * Menampilkan daftar kota untuk admin
     */
    public function index()
    {
        $kota = Kota::all();
        return view('admin.kota.index', compact('kota'));
    }

    /**
     * Menampilkan form tambah kota
     */
    public function create()
    {
        return view('admin.kota.create');
    }

    /**
     * Menyimpan data kota baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kota' => 'required|string|max:255',
            'umr' => 'required|numeric|min:0',
            'waktu_tempuh' => 'required|numeric|min:0',
            'jumlah_armada' => 'required|integer|min:0',
            'jumlah_kendaraan_pribadi' => 'required|integer|min:0',
            'tarif_minimum_aktual' => 'required|numeric|min:0'
        ]);

        Kota::create($request->all());

        // Hapus hasil perhitungan lama karena ada data kota baru
        HasilPerhitungan::truncate();
        TarifRekomendasi::truncate();

        return redirect()->route('admin.kota.index')
            ->with('success', 'Data kota berhasil disimpan! Perhitungan akan direset karena ada data baru.');
    }

    /**
     * Menampilkan form edit kota
     */
    public function edit($id)
    {
        $kota = Kota::findOrFail($id);
        return view('admin.kota.edit', compact('kota'));
    }

    /**
     * Update data kota
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kota' => 'required|string|max:255',
            'umr' => 'required|numeric|min:0',
            'waktu_tempuh' => 'required|numeric|min:0',
            'jumlah_armada' => 'required|integer|min:0',
            'jumlah_kendaraan_pribadi' => 'required|integer|min:0',
            'tarif_minimum_aktual' => 'required|numeric|min:0'
        ]);

        $kota = Kota::findOrFail($id);
        $kota->update($request->all());

        // Hapus hasil perhitungan lama karena data kota diubah
        HasilPerhitungan::truncate();
        TarifRekomendasi::truncate();

        return redirect()->route('admin.kota.index')
            ->with('success', 'Data kota berhasil diperbarui! Perhitungan akan direset karena data berubah.');
    }

    /**
     * Hapus data kota
     */
    public function destroy($id)
    {
        $kota = Kota::findOrFail($id);
        
        // Hapus data terkait terlebih dahulu
        HasilPerhitungan::where('kota_id', $id)->delete();
        TarifRekomendasi::where('kota_acuan_id', $id)->orWhere('kota_banding_id', $id)->delete();
        
        $kota->delete();

        return redirect()->route('admin.kota.index')
            ->with('success', 'Data kota berhasil dihapus!');
    }

    /**
     * Menampilkan hasil perhitungan untuk admin
     */
    public function hasil()
    {
        $kota = Kota::with('hasilPerhitungan.kriteria')->get();
        $kriteria = Kriteria::all();
        $bobot = Bobot::all()->keyBy('kode_kriteria');

        return view('admin.hasil', compact('kota', 'kriteria', 'bobot'));
    }

    /**
     * Menampilkan perbandingan untuk admin
     */
    public function perbandingan()
    {
        $kota = Kota::all();
        $perbandingan = TarifRekomendasi::with(['kotaAcuan', 'kotaBanding'])->latest()->get();
        
        return view('admin.perbandingan', compact('kota', 'perbandingan'));
    }

    /**
     * Reset semua data perhitungan
     */
    public function resetPerhitungan()
    {
        HasilPerhitungan::truncate();
        TarifRekomendasi::truncate();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Semua data perhitungan berhasil direset!');
    }
}