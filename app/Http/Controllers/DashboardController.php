<?php

namespace App\Http\Controllers;

use App\Models\AreaParkir;
use App\Models\Kendaraan;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request) {
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
    }
}
