<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    // 1. Tampilkan Daftar Barang
    public function index()
    {
        // Hanya Owner & Manager yang bisa mengakses
        if (!in_array(Auth::user()->role, ['owner', 'manager'])) {
            abort(403, 'Anda tidak memiliki akses ke halaman Master Data ini.');
        }

        // Ambil semua barang dari database, urutkan berdasarkan nama
        $barangs = Barang::orderBy('nama', 'asc')->get();
        return view('master.barang.index', compact('barangs'));
    }

    // 2. Form Tambah Barang Baru
    public function create()
    {
        if (!in_array(Auth::user()->role, ['owner', 'manager'])) {
            abort(403, 'Akses ditolak.');
        }
        return view('master.barang.create');
    }

    // 3. Simpan Barang Baru ke Database
    public function store(Request $request)
    {
        if (!in_array(Auth::user()->role, ['owner', 'manager'])) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'kode_barang' => 'required|string|max:50|unique:barangs,kode_barang',
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        Barang::create([
            'kode_barang' => $request->kode_barang,
            'nama' => $request->nama,
            'harga' => $request->harga,
        ]);

        return redirect()->route('master.barang')->with('success', 'Barang baru berhasil ditambahkan.');
    }

    // 4. Form Edit Barang (Termasuk Update Harga)
    public function edit(Barang $barang)
    {
        if (!in_array(Auth::user()->role, ['owner', 'manager'])) {
            abort(403, 'Akses ditolak.');
        }
        return view('master.barang.edit', compact('barang'));
    }

    // 5. Simpan Perubahan (Update Harga)
    public function update(Request $request, Barang $barang)
    {
        if (!in_array(Auth::user()->role, ['owner', 'manager'])) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            // Pengecualian ID agar tidak dianggap duplikat saat edit kode yang sama
            'kode_barang' => 'required|string|max:50|unique:barangs,kode_barang,' . $barang->id, 
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        $barang->update([
            'kode_barang' => $request->kode_barang,
            'nama' => $request->nama,
            'harga' => $request->harga,
        ]);

        return redirect()->route('master.barang')->with('success', 'Data barang berhasil diupdate.');
    }

    // 6. Hapus Barang
    public function destroy(Barang $barang)
    {
        if (!in_array(Auth::user()->role, ['owner', 'manager'])) {
            abort(403, 'Akses ditolak.');
        }
        
        $barang->delete();
        return redirect()->route('master.barang')->with('success', 'Barang berhasil dihapus.');
    }
}