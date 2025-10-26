<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Simpanan;
use App\Models\Biodata;
use Illuminate\Support\Facades\Auth;

class SimpananController extends Controller
{
    // Tambah Simpanan
    public function store(Request $request)
    {
        $request->validate([
            'jenis_simpanan' => 'required','string', Rule::in(['pokok', 'wajib', 'sukarela']),
            'jumlah' => 'required|numeric|min:0.01|max:9999999999.99',
        ]);

        //menggunakan model simpanan untuk menyimpan data
        Simpanan::create([ 
            'id_anggota'=>auth()->id(),
            'jenis_simpanan'=>$request->jenis_simpanan,
            'jumlah'=>$request->jumlah]);
        return redirect()->route('anggota.simpanan.index')->with('succes', 'Simpanan berhasil ditambahkan');
    }


    //lihat simpanan
    public function index()
    {
        $anggotaId = Auth::id();
        $riwayatSimpanan = Simpanan::where('id_anggota', $anggotaId)->get();
        return view('simpanan.index', ['simpaans'=>$riwayatSimpanan]);
    }

    //hapus simpanan
    public function destroy (Simpanan $simpanan)
    {
        if ($simpanan->id_anggota !==Auth::id()){
            return redirect('error', 'Anda tidak diizinkan menghapus simpanan anggota lain');
        }
        $simpanan->delete();
        return redirect()->route('anggota.simpanan.index')->with('succes','Simpanan berhasil dihapus');

    }
}
