<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Pinjaman;
use App\Models\Simpanan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private function getFilteredData(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate   = $request->input('end_date');
        $jenis     = $request->input('jenis_laporan');
        
        $simpananQuery = Simpanan::query();
        if ($startDate && $endDate) {
            $simpananQuery->whereBetween('tanggal', [$startDate, $endDate]);
        }
        $simpanan = $simpananQuery->get()->map(function ($item) {
            $item->jenis_label = 'Simpanan';
            $item->kategori    = 'pemasukan'; 
            return $item;
        });

        $pinjamanQuery = Pinjaman::where('status', 'disetujui');
        if ($startDate && $endDate) {
            $pinjamanQuery->whereBetween('tanggal', [$startDate, $endDate]);
        }
        $pinjaman = $pinjamanQuery->get()->map(function ($item) {
            
            if (!isset($item->tanggal)) {
                $item->tanggal = $item->tanggal_pengajuan; 
            }
            $item->jenis_label = 'Pinjaman';
            $item->kategori    = 'pengeluaran'; 
            return $item;
        });
        
        $data = collect();

        if ($jenis == 'pemasukan') {
            $data = $simpanan;
        } elseif ($jenis == 'pengeluaran') {
            $data = $pinjaman;
        } else {
            $data = $simpanan->merge($pinjaman);
        }
        
        return $data->sortByDesc('tanggal');
    }

    public function index(Request $request)
    {
        $data = $this->getFilteredData($request);

        $pemasukan   = $data->where('kategori', 'pemasukan')->sum('jumlah');
        $pengeluaran = $data->where('kategori', 'pengeluaran')->sum('jumlah'); // Pastikan kolom 'jumlah' ada di tabel pinjaman
        $saldoBersih = $pemasukan - $pengeluaran;

        return view('admin.laporan-keuangan', compact('data', 'pemasukan', 'pengeluaran', 'saldoBersih'));
    }

    public function exportCsv(Request $request)
    {
        $data = $this->getFilteredData($request);
        $fileName = 'laporan-keuangan-' . \Carbon\Carbon::now()->format('Y-m-d_H-i') . '.csv';

        return response()->streamDownload(function () use ($data) {
            $file = fopen('php://output', 'w');

            // Header CSV
            fputcsv($file, ['Tanggal', 'Jenis Transaksi', 'Keterangan', 'Nominal (Rp)']);

            // Isi Data
            foreach ($data as $item) {
                fputcsv($file, [
                    $item->tanggal,
                    $item->jenis_label,
                    $item->keterangan ?? '-', // Handle jika kolom keterangan kosong
                    $item->jumlah
                ]);
            }

            fclose($file);
        }, $fileName);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Laporan $laporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laporan $laporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Laporan $laporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laporan $laporan)
    {
        //
    }
}
