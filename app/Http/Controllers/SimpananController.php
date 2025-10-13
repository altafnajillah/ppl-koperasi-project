<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Simpanan;
use App\Models\Biodata;

class SimpananController extends Controller
{
    // Tampilkan form tambah simpanan
    public function create()
    {
        // Ambil daftar anggota (biodata) untuk dropdown
        $biodatas = Biodata::all();
        return view('simpanan.create', compact('biodatas'));
    }

    // Simpan simpanan baru
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:biodatas,id',
            'jenis_simpanan' => 'required|in:pokok,wajib,sukarela',
            'jumlah' => 'required|numeric|min:0',
        ]);

        Simpanan::create($validatedData);

        return redirect()->route('simpanan.index', ['biodata' => $validatedData['user_id']])
            ->with('success', 'Data simpanan berhasil ditambahkan!');
    }

    // Tampilkan daftar simpanan milik anggota tertentu
    public function index(Biodata $biodata)
    {
        $simpanan = Simpanan::where('user_id', $biodata->id)->get();
        return view('simpanan.index', compact('simpanan', 'biodata'));
    }

    // Hapus simpanan
    public function destroy(Simpanan $simpanan)
    {
        $simpanan->delete();
        
        // Redirect ke halaman daftar simpanan anggota yang sama
        return redirect()->route('simpanan.index', ['biodata' => $simpanan->user_id])
            ->with('success', 'Data simpanan berhasil dihapus!');
    }
}
