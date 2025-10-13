<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjaman;
use App\Models\Biodata;

class PinjamanController extends Controller
{
    // Tampilkan form ajukan pinjaman
    public function create()
    {
        // Ambil daftar anggota untuk dropdown
        $biodatas = Biodata::all();
        return view('pinjaman.create', compact('biodatas'));
    }

    // Simpan pinjaman baru
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:biodatas,id', 
            'jumlah' => 'required|numeric|min:0',
            'tenor' => 'required|integer|max:2', // tenor dalam bulan
        ]);

        Pinjaman::create($validatedData);

        return redirect()->route('pinjaman.index', ['biodata' => $validatedData['user_id']])
            ->with('success', 'Pinjaman berhasil diajukan!');
    }

    // Setujui pinjaman
    public function approve(Pinjaman $pinjaman)
    {
        $pinjaman->status = 'disetujui';
        $pinjaman->save();

        return redirect()->back()->with('success', 'Pinjaman berhasil disetujui.');
    }

    // Lihat pinjaman berdasarkan anggota biodata
    public function index(Biodata $biodata)
    {
        $pinjaman = Pinjaman::where('user_id', $biodata->id)
                            ->select('id', 'jumlah', 'tenor', 'status')
                            ->get();

        return view('pinjaman.index', compact('pinjaman', 'biodata'));
    }
}
