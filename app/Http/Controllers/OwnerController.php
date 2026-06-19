<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cabang;
use App\Models\Stok;
use App\Models\Transaksi;
use App\Models\StokOpname;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class OwnerController extends Controller
{
    // ==========================================
    // 1. MENU KELOLA CABANG (CRUD UTAMA)
    // ==========================================
    
    // Tampilan Daftar Cabang
    public function cabang()
    {
        $cabangs = Cabang::all();
        return view('owner.cabang', compact('cabangs'));
    }

    // Tampilan Form Tambah Cabang
    public function createCabang()
    {
        return view('owner.cabang_form');
    }

    // Proses Simpan Cabang Baru ke Database
    public function storeCabang(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kota' => 'required|string|max:255', // <-- Tambahan validasi kota
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
        ]);

        Cabang::create([
            'nama' => $request->nama,
            'kota' => $request->kota,   // <-- Tambahan simpan kota ke database
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);

        return redirect()->route('owner.cabang')->with('success', 'Cabang baru berhasil ditambahkan!');
    }

    // Tampilan Form Edit Cabang
    public function editCabang(Cabang $cabang)
    {
        return view('owner.cabang_form', compact('cabang'));
    }

    // Proses Simpan Perubahan Data Cabang
    public function updateCabang(Request $request, Cabang $cabang)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kota' => 'required|string|max:255', // <-- Tambahan validasi kota
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
        ]);

        $cabang->update([
            'nama' => $request->nama,
            'kota' => $request->kota,   // <-- Tambahan simpan kota ke database
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);

        return redirect()->route('owner.cabang')->with('success', 'Data cabang berhasil diperbarui!');
    }

    // Proses Hapus Cabang
    public function destroyCabang(Cabang $cabang)
    {
        $cabang->delete();
        return redirect()->route('owner.cabang')->with('success', 'Cabang berhasil dihapus!');
    }

    // ==========================================
    // 2. MENU PANTAU STOK, TRANSAKSI, & LAPORAN
    // ==========================================

    // Menu Pantau Semua Stok
    public function stok(Request $request)
    {
        $search = $request->search;

        $stoks = Stok::with(['barang', 'cabang'])
                    ->when($search, function ($query) use ($search) {
                        $query->whereHas('barang', function ($q) use ($search) {
                            $q->where('nama', 'like', '%' . $search . '%');
                        });
                    })
                    ->get()
                    // Mengelompokkan dan mengurutkan berdasarkan Nama Barang (A-Z)
                    ->sortBy(function ($stok) {
                        return $stok->barang->nama . '-' . $stok->cabang_id;
                    });

        return view('owner.stok', compact('stoks'));
    }

    // Menu Pantau Semua Transaksi
    public function transaksi(Request $request)
    {
        $query = Transaksi::with(['user', 'cabang']);

        // Filter berdasarkan tanggal jika ada input
        if ($request->date) {
            $query->whereDate('created_at', $request->date);
        }

        $transaksis = $query->orderBy('created_at', 'desc')->get();
        
        return view('owner.transaksi', compact('transaksis'));
    }

    // Menu Laporan Gabungan
    public function laporan(Request $request)
    {
        $start_date = $request->start_date ? Carbon::parse($request->start_date)->startOfDay() : Carbon::today();
        $end_date = $request->end_date ? Carbon::parse($request->end_date)->endOfDay() : Carbon::today();

        $transaksis = Transaksi::with(['cabang', 'user'])
                        ->whereBetween('created_at', [$start_date, $end_date])
                        ->get();
        
        $total_pendapatan = $transaksis->sum('total_harga');

        $opnames = StokOpname::with(['barang', 'cabang', 'user'])
                        ->whereBetween('created_at', [$start_date, $end_date])
                        ->get();

        return view('owner.laporan', compact('transaksis', 'total_pendapatan', 'opnames', 'start_date', 'end_date'));
    }

    // Fungsi Cetak PDF Laporan Gabungan
    public function cetakPDF(Request $request)
    {
        $start_date = $request->start_date ? Carbon::parse($request->start_date)->startOfDay() : Carbon::today();
        $end_date = $request->end_date ? Carbon::parse($request->end_date)->endOfDay() : Carbon::today();

        $transaksis = Transaksi::with(['cabang', 'user'])
                        ->whereBetween('created_at', [$start_date, $end_date])
                        ->get();
        
        $total_pendapatan = $transaksis->sum('total_harga');

        $opnames = StokOpname::with(['barang', 'cabang', 'user'])
                        ->whereBetween('created_at', [$start_date, $end_date])
                        ->get();

        $pdf = Pdf::loadView('owner.laporan_pdf', compact('transaksis', 'total_pendapatan', 'opnames', 'start_date', 'end_date'));
        
        // Atur ukuran kertas ke A4
        $pdf->setPaper('a4', 'portrait');

        return $pdf->download('Laporan_Minimarket_Jayusman.pdf');
    }
}