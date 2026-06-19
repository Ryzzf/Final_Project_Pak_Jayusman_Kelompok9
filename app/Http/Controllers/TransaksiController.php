<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stok;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    // 1. Fungsi untuk MENAMPILKAN HALAMAN KASIR
    public function create()
    {
        // Ambil ID cabang tempat kasir ini bekerja
        $cabang_id = Auth::user()->cabang_id;

        // Ambil barang yang HANYA ADA STOKNYA di cabang ini
        $stoks = Stok::with('barang')
                     ->where('cabang_id', $cabang_id)
                     ->where('quantity', '>', 0)
                     ->get();

        return view('kasir.create', compact('stoks'));
    }

    // 2. Fungsi untuk MENYIMPAN TRANSAKSI & MENGURANGI STOK
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|array',
            'qty' => 'required|array',
            'total_harga' => 'required|numeric'
        ]);

        $cabang_id = Auth::user()->cabang_id;

        // Gunakan DB Transaction agar jika ada error di tengah jalan, data di-rollback (dibatalkan)
        DB::beginTransaction();
        try {
            // BUAT KODE TRANSAKSI OTOMATIS (Contoh hasil: TRX-20260603-A8B9C)
            $kode_transaksi = 'TRX-' . date('Ymd') . '-' . strtoupper(Str::random(5));

            // A. Simpan ke tabel transaksis utama
            $transaksi = Transaksi::create([
                'kode_transaksi' => $kode_transaksi,
                'user_id' => Auth::id(), // ID Kasir
                'cabang_id' => $cabang_id,
                'total_harga' => $request->total_harga,
                'tanggal' => now(),
            ]);

            // B. Looping barang yang dibeli
            foreach ($request->barang_id as $key => $b_id) {
                $qty_beli = $request->qty[$key];
                
                // Cari data barang untuk mendapatkan harganya
                $barang = Barang::findOrFail($b_id);

                // 1. Simpan ke detail transaksi (Harga disimpan agar aman dari perubahan harga di masa depan)
                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $b_id,
                    'qty' => $qty_beli,
                    'harga_saat_transaksi' => $barang->harga,
                ]);

                // 2. Kurangi stok di cabang tersebut
                $stok_cabang = Stok::where('cabang_id', $cabang_id)
                                   ->where('barang_id', $b_id)
                                   ->first();
                
                $stok_cabang->quantity -= $qty_beli;
                $stok_cabang->save();
            }

            DB::commit(); // Simpan permanen ke database

            // LANGSUNG ARAHKAN KE HALAMAN CETAK STRUK
            return redirect()->route('transaksi.struk', $transaksi->id);

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua jika error
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    // 3. Fungsi untuk MENAMPILKAN STRUK TRANSAKSI
    public function cetakStruk($id)
    {
        // Ambil data transaksi beserta relasinya (detail barang, nama kasir, nama cabang)
        $transaksi = Transaksi::with(['details.barang', 'user', 'cabang'])->findOrFail($id);

        return view('kasir.struk', compact('transaksi'));
    }

    // 4. Fungsi untuk DOWNLOAD STRUK PDF
    public function cetakPDF($id)
    {
        $transaksi = Transaksi::with(['details.barang', 'user', 'cabang'])->findOrFail($id);

        // Tambahkan variabel penanda bahwa ini sedang di-render sebagai PDF
        $is_pdf = true; 

        // Masukkan $is_pdf ke dalam compact()
        $pdf = Pdf::loadView('kasir.struk', compact('transaksi', 'is_pdf'));
        
        $pdf->setPaper([0, 0, 226.77, 500], 'portrait'); 

        return $pdf->download('Struk_' . $transaksi->kode_transaksi . '.pdf');
    }
}