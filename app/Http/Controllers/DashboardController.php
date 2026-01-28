<?php

namespace App\Http\Controllers;

use App\Models\AreaParkir;
use App\Models\Kendaraan;
use App\Models\Transaksi;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    /**
     * /
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     * 
     * 
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $startDate = $request->input('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->endOfMonth()->format('Y-m-d'));

        $start = Carbon::parse($startDate)->startOfDay();
        $end = Carbon::parse($endDate)->endOfDay();

        $totalKendaraan = Kendaraan::count();
        $totalAreaParkir = AreaParkir::count();
        $totalKapasitas = AreaParkir::sum('kapasitas');
        $totalTerisi = AreaParkir::sum('terisi');
        $kapasitasTersedia = $totalKapasitas - $totalTerisi;

        $totalTransaksi = Transaksi::whereBetween('waktu_masuk', [$start, $end])->count();
        $transaksiMasuk = Transaksi::whereBetween('waktu_masuk', [$start, $end])->where('status', 'masuk')->count();
        $transaksiKeluar = Transaksi::whereBetween('waktu_masuk', [$start, $end])->where('status', 'keluar')->count();
        $totalPendapatan = Transaksi::whereBetween('waktu_masuk', [$start, $end])->where('status', 'keluar')->sum('biaya_total');

        $transaksiTerbaru = Transaksi::with(['kendaraan', 'area'])->whereBetween('waktu_masuk', [$start, $end])->orderBy('waktu_masuk', 'desc')->limit(10)->get();

        $statistikArea = AreaParkir::get()->map(function ($area) use ($start, $end) {
            $transaksis = Transaksi::where('id_area', $area->id)
                ->whereBetween('waktu_masuk', [$start, $end]);

            $area->total_transaksi = $transaksis->count();
            $area->pendapatan_area = $transaksis->where('status', 'keluar')->sum('biaya_total');

            return $area;
        });

        $statistikPerPetugas = null;
        if ($user->role === 'admin') {
            $statistikPerPetugas = User::where('role', 'petugas')->get()->map(function ($petugas) use ($start, $end) {
                $petugas->total_transaksi = Transaksi::where('id_user', $petugas->id)
                    ->whereBetween('waktu_masuk', [$start, $end])->count();

                return $petugas;
            });
        }

        return view('dashboard', compact(
            'user',
            'startDate',
            'endDate',
            'totalKendaraan',
            'totalAreaParkir',
            'totalKapasitas',
            'totalTerisi',
            'kapasitasTersedia',
            'totalTransaksi',
            'transaksiMasuk',
            'transaksiKeluar',
            'totalPendapatan',
            'transaksiTerbaru',
            'statistikArea',
            'statistikPerPetugas'
        ));
    }

    public function cetakRekapTransaksi(Request $request) {
        $startDate = $request->input('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->endOfMonth()->format('Y-m-d'));

        $start = Carbon::parse($startDate)->startOfDay();
        $end = Carbon::parse($endDate)->endOfDay();

        $transaksis = Transaksi::with(['kendaraan', 'area', 'user', 'tarif'])
                                ->whereBetween('waktu_masuk', [$start, $end])
                                ->orderBy('waktu_masuk')->get();

        $totalTransaksi = $transaksis->count();
        $transaksiMasuk = $transaksis->where('status', 'masuk')->count();
        $transaksiKeluar = $transaksis->where('status', 'keluar')->count();
        $totalPendapatan = $transaksis->where('status', 'keluar')->sum('biaya_total');

        $statistikArea = AreaParkir::get(['*'])->map(function ($area) use ($transaksis) {
            $transaksiArea = $transaksis->where('id_area', $area->id);
            $area->total_transaksi = $transaksiArea->count();
            $area->pendapatan_area = $transaksiArea->where('status', 'keluar')->sum('biaya_total');
            return $area;
        })->where('total_transaksi', '>', 0);

        $pdf = Pdf::loadView('dashboard.rekapTransaksi', compact(
            'transaksis', 'startDate', 'endDate', 'totalTransaksi', 'transaksiMasuk', 'transaksiKeluar',
            'totalPendapatan', 'statistikArea'
        ));

        return $pdf->stream('rekap_transaksi' . $startDate . '_to_' . $endDate . '.pdf');
    }
}
