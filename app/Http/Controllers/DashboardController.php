<?php

namespace App\Http\Controllers;

use App\Models\AreaParkir;
use App\Models\Kendaraan;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Filter tanggal - default bulan ini
        $startDate = $request->input('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->endOfMonth()->format('Y-m-d'));
        
        $start = Carbon::parse($startDate)->startOfDay();
        $end = Carbon::parse($endDate)->endOfDay();

        // Stats Umum
        $totalKendaraan = Kendaraan::count();
        $totalAreaParkir = AreaParkir::count();
        $kapasitasTotal = AreaParkir::sum('kapasitas');
        $terisiTotal = AreaParkir::sum('terisi');
        $kapasitasTersedia = $kapasitasTotal - $terisiTotal;

        // Stats Transaksi Periode
        $totalTransaksi = Transaksi::whereBetween('waktu_masuk', [$start, $end])->count();
        $transaksiMasuk = Transaksi::whereBetween('waktu_masuk', [$start, $end])
            ->where('status', 'masuk')->count();
        $transaksiKeluar = Transaksi::whereBetween('waktu_masuk', [$start, $end])
            ->where('status', 'keluar')->count();
        $totalPendapatan = Transaksi::whereBetween('waktu_masuk', [$start, $end])
            ->where('status', 'keluar')->sum('biaya_total');

        // Transaksi Terbaru
        $transaksiTerbaru = Transaksi::with(['kendaraan', 'area'])
            ->whereBetween('waktu_masuk', [$start, $end])
            ->orderBy('waktu_masuk', 'desc')
            ->limit(10)
            ->get();

        // Statistik Per Area
        $statistikArea = AreaParkir::get()->map(function($area) use ($start, $end) {
            $transaksis = Transaksi::where('id_area', $area->id)
                ->whereBetween('waktu_masuk', [$start, $end]);
            
            $area->total_transaksi = $transaksis->count();
            $area->pendapatan_area = $transaksis->where('status', 'keluar')->sum('biaya_total');
            
            return $area;
        });

        // Khusus Admin - Statistik Per Petugas
        $statistikPerPetugas = null;
        if ($user->role === 'admin') {
            $statistikPerPetugas = User::where('role', 'petugas')->get()->map(function($petugas) use ($start, $end) {
                $petugas->total_transaksi = Transaksi::where('id_user', $petugas->id)
                    ->whereBetween('waktu_masuk', [$start, $end])
                    ->count();
                
                return $petugas;
            });
        }

        return view('dashboard', compact(
            'user',
            'startDate',
            'endDate',
            'totalKendaraan',
            'totalAreaParkir',
            'kapasitasTotal',
            'terisiTotal',
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
}
