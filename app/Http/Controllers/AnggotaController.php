<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $pinjamanAktif = $user->pinjaman->count();
        $pinjamanJumlah = $user->pinjaman->sum('jumlah');
        $simpananJumlah = $user->simpanan->sum('jumlah');
        $angsurans = Pinjaman::where('user_id', $user->id)
            ->with(['angsuran' => function ($query) {
                $query->select('id', 'pinjaman_id', 'tanggal', 'jumlah');
            }])
            ->select('id', 'alasan')
            ->get()
            ->flatMap(function ($pinjaman) {
                return $pinjaman->angsuran->map(function ($angsuran) use ($pinjaman) {
                    $angsuran->alasan = $pinjaman->alasan;

                    return $angsuran;
                });
            })
            ->sortBy('tanggal')
            ->take(8);

        return view('anggota.dashboard', [
            'user' => $user,
            'pinjamanAktif' => $pinjamanAktif,
            'pinjamanJumlah' => $pinjamanJumlah,
            'simpananJumlah' => $simpananJumlah,
            'angsurans' => $angsurans,
        ]);
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if (Hash::check($validated['current_password'], $user->password)) {
            $user->password = Hash::make($validated['password']);
            $user->save();

            return redirect()->back()->with('success', 'Password berhasil diubah');
        } else {
            return redirect()->back()->with('error', 'Gagal mengubah password');
        }
    }
}
