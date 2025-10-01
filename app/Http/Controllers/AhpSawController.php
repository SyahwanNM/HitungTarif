<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kota;
use App\Models\Kriteria;
use App\Models\Bobot;
use App\Models\HasilPerhitungan;
use App\Models\TarifRekomendasi;
use Illuminate\Support\Facades\DB;

class AhpSawController extends Controller
{
    /**
     * Menampilkan halaman input data kota
     */
    public function index()
    {
        $kota = Kota::all();
        return view('ahp-saw.index', compact('kota'));
    }

    /**
     * Menampilkan form input data kota baru
     */
    public function create()
    {
        return view('ahp-saw.create');
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
            'tarif_minimum_aktual' => 'nullable|numeric|min:0'
        ]);

        Kota::create($request->all());

        return redirect()->route('ahp-saw.index')
            ->with('success', 'Data kota berhasil disimpan!');
    }

    /**
     * Menampilkan form perhitungan AHP dan SAW
     */
    public function perhitungan()
    {
        $kota = Kota::all();
        $kriteria = Kriteria::all();
        $bobot = Bobot::all()->keyBy('kode_kriteria');
        
        // Jika ada hasil perhitungan, ambil data untuk ditampilkan
        $kotaDenganHasil = null;
        if (HasilPerhitungan::count() > 0) {
            $kotaDenganHasil = Kota::with('hasilPerhitungan.kriteria')->get();
        }
        
        return view('ahp-saw.perhitungan', compact('kota', 'kriteria', 'bobot', 'kotaDenganHasil'));
    }

    /**
     * Melakukan perhitungan AHP dan SAW
     */
    public function hitung(Request $request)
    {
        $kota = Kota::all();
        $kriteria = Kriteria::all();
        $bobot = Bobot::all()->keyBy('kode_kriteria');

        // Hapus hasil perhitungan lama
        HasilPerhitungan::truncate();

        // Lakukan perhitungan SAW untuk setiap kota
        foreach ($kota as $k) {
            $skorPreferensi = 0;
            
            foreach ($kriteria as $kr) {
                $nilaiKriteria = $this->getNilaiKriteria($k, $kr->kode_kriteria);
                $nilaiNormalisasi = $this->hitungNormalisasi($nilaiKriteria, $kr, $kota);
                $skorPreferensi += $nilaiNormalisasi * $bobot[$kr->kode_kriteria]->bobot;

                // Simpan hasil perhitungan
                HasilPerhitungan::create([
                    'kota_id' => $k->id,
                    'kode_kriteria' => $kr->kode_kriteria,
                    'nilai_asli' => $nilaiKriteria,
                    'nilai_normalisasi' => $nilaiNormalisasi,
                    'bobot' => $bobot[$kr->kode_kriteria]->bobot,
                    'skor_preferensi' => $nilaiNormalisasi * $bobot[$kr->kode_kriteria]->bobot
                ]);
            }

            // Update skor preferensi total (tambahkan kolom ini ke migration jika belum ada)
            // $k->update(['skor_preferensi_total' => $skorPreferensi]);
        }

        return redirect()->route('ahp-saw.perhitungan')
            ->with('success', 'Perhitungan AHP dan SAW berhasil dilakukan!')
            ->with('show_results', true);
    }

    /**
     * Menampilkan hasil perhitungan
     */
    public function hasil()
    {
        $kota = Kota::with('hasilPerhitungan.kriteria')->get();
        $kriteria = Kriteria::all();
        $bobot = Bobot::all()->keyBy('kode_kriteria');

        return view('ahp-saw.hasil', compact('kota', 'kriteria', 'bobot'));
    }

    /**
     * Menampilkan form perbandingan kota
     */
    public function perbandingan()
    {
        $kota = Kota::all();
        
        // Hanya Jakarta dan Bandung yang bisa menjadi kota acuan (karena memiliki actual minimum value)
        $kotaAcuan = Kota::whereIn('nama_kota', ['Jakarta', 'Bandung'])->get();
        
        // Jika belum ada hasil perhitungan, jalankan perhitungan terlebih dahulu
        if (HasilPerhitungan::count() == 0) {
            $this->hitung(new Request());
        }
        
        return view('ahp-saw.perbandingan', compact('kota', 'kotaAcuan'));
    }

    /**
     * Melakukan perbandingan dua kota
     */
    public function bandingkan(Request $request)
    {
        $request->validate([
            'kota_acuan_id' => 'required|exists:kota,id',
            'kota_banding_id' => 'required|exists:kota,id|different:kota_acuan_id'
        ]);

        $kotaAcuan = Kota::findOrFail($request->kota_acuan_id);
        $kotaBanding = Kota::findOrFail($request->kota_banding_id);

        // Hitung skor preferensi jika belum ada
        $skorAcuan = $kotaAcuan->hasilPerhitungan->sum('skor_preferensi');
        $skorBanding = $kotaBanding->hasilPerhitungan->sum('skor_preferensi');
        
        if ($skorAcuan == 0 || $skorBanding == 0) {
            $this->hitung(new Request());
            $kotaAcuan->refresh();
            $kotaBanding->refresh();
            $skorAcuan = $kotaAcuan->hasilPerhitungan->sum('skor_preferensi');
            $skorBanding = $kotaBanding->hasilPerhitungan->sum('skor_preferensi');
        }

        // Hitung tarif rekomendasi
        $tarifRekomendasi = $this->hitungTarifRekomendasi($kotaAcuan, $kotaBanding);

        return view('ahp-saw.hasil-perbandingan', compact('kotaAcuan', 'kotaBanding', 'tarifRekomendasi'));
    }

    /**
     * Mendapatkan nilai kriteria untuk kota tertentu
     */
    private function getNilaiKriteria($kota, $kodeKriteria)
    {
        switch ($kodeKriteria) {
            case 'C1': // UMR - hitung UMR / tarif minimum aktual
                if ($kota->tarif_minimum_aktual && $kota->tarif_minimum_aktual > 0) {
                    return $kota->umr / $kota->tarif_minimum_aktual;
                }
                return $kota->umr;
            case 'C2': // Waktu tempuh
                return $kota->waktu_tempuh;
            case 'C3': // Jumlah armada
                return $kota->jumlah_armada;
            case 'C4': // Jumlah kendaraan pribadi
                return $kota->jumlah_kendaraan_pribadi;
            default:
                return 0;
        }
    }

    /**
     * Menghitung normalisasi SAW
     */
    private function hitungNormalisasi($nilai, $kriteria, $semuaKota)
    {
        $nilaiKriteria = $semuaKota->map(function($kota) use ($kriteria) {
            return $this->getNilaiKriteria($kota, $kriteria->kode_kriteria);
        });

        if ($kriteria->jenis == 'benefit') {
            $max = $nilaiKriteria->max();
            return $max > 0 ? $nilai / $max : 0;
        } else { // cost
            $min = $nilaiKriteria->min();
            return $min > 0 ? $min / $nilai : 0;
        }
    }

    /**
     * Menghitung tarif rekomendasi berdasarkan perbandingan skor
     */
    private function hitungTarifRekomendasi($kotaAcuan, $kotaBanding)
    {
        $skorAcuan = $kotaAcuan->hasilPerhitungan->sum('skor_preferensi');
        $skorBanding = $kotaBanding->hasilPerhitungan->sum('skor_preferensi');
        
        // Gunakan tarif minimum kota acuan
        $tarifAcuan = $kotaAcuan->tarif_minimum_aktual ?? 8000; // Default 8000 jika tidak ada
        
        // Hitung tarif rekomendasi berdasarkan rasio skor
        $rasioSkor = $skorBanding / $skorAcuan;
        $tarifRekomendasi = $tarifAcuan * $rasioSkor;
        
        // Simpan hasil perbandingan
        $perbandingan = TarifRekomendasi::create([
            'kota_acuan_id' => $kotaAcuan->id,
            'kota_banding_id' => $kotaBanding->id,
            'tarif_acuan' => $tarifAcuan,
            'skor_acuan' => $skorAcuan,
            'skor_banding' => $skorBanding,
            'tarif_rekomendasi' => $tarifRekomendasi,
            'tarif_aktual' => $kotaBanding->tarif_minimum_aktual,
            'selisih' => $kotaBanding->tarif_minimum_aktual ? 
                $tarifRekomendasi - $kotaBanding->tarif_minimum_aktual : null
        ]);

        return $perbandingan;
    }

    /**
     * Menampilkan matriks keputusan awal
     */
    public function matriks()
    {
        $kota = Kota::all();
        return view('ahp-saw.index', compact('kota'));
    }

    /**
     * Menampilkan halaman hitung tarif (menggunakan view yang sudah ada)
     */
    public function hitungTarif()
    {
        $kota = Kota::all();
        return view('hitungtarif', compact('kota'));
    }
}