<?php

namespace App\Http\Controllers;

use App\Models\AreaParkir;
use App\Models\Kendaraan;
use App\Models\LogAktivitas;
use App\Models\Tarif;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Transaksi::with(['kendaraan', 'areaParkir', 'user', 'tarif'])->paginate(10);
        return view('petugas.transaksi.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('petugas.transaksi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kendaraan' => 'required|exists:kendaraans,id',
            'waktu_masuk' => 'required|datetime',
            'waktu_keluar' => 'nullable|datetime|after:waktu_masuk',
            'id_tarif' => 'required|exists:tarifs,id',
            'durasi_jam' => 'nullable|integer|min:0',
            'biaya_total' => 'nullable|decimal:10,0',
            'status' => 'required|in:masuk,keluar',
            'id_area' => 'required|exists:area_parkirs,id'
        ]);

        try {
            DB::beginTransaction();

            $data = Transaksi::create($validated);
            $log = LogAktivitas::create([
                'id_user' => Auth::user()->id,
                'aktivitas' => 'Menambahkan transaksi untuk kendaraan ID ' . $validated['id_kendaraan'],
                'waktu_aktivitas' => now()
            ]);

            DB::commit();
            return redirect()->route('petugas.transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('petugas.transaksi.index')->with('error', 'Transaksi gagal ditambahkan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kendaraan = Kendaraan::select(['id', 'plat_nomor', 'jenis_kendaraan', 'warna', 'pemilik'])->get();
        $tarif = Tarif::select(['id', 'jenis_kendaraan', 'harga_per_jam'])->get();
        $area = AreaParkir::select(['id', 'nama_area', 'kapasitas', 'terisi'])->get();
        $user = User::select(['id', 'name'])->get();
        $data = Transaksi::findOrFail($id);
        return view('petugas.transaksi.update', [
            'data' => $data,
            'kendaraan' => $kendaraan,
            'tarif' => $tarif,
            'area' => $area,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'id_kendaraan' => 'sometimes|exists:kendaraans,id',
            'waktu_masuk' => 'sometimes|datetime',
            'waktu_keluar' => 'nullable|datetime|after:waktu_masuk',
            'id_tarif' => 'sometimes|exists:tarifs,id',
            'durasi_jam' => 'nullable|integer|min:0',
            'biaya_total' => 'nullable|decimal:10,0',
            'status' => 'sometimes|in:masuk,keluar',
            'id_area' => 'sometimes|exists:area_parkirs,id'
        ]);

        try {
            DB::beginTransaction();

            $data = Transaksi::findOrFail($id);
            $data->update($validated);

            $log = LogAktivitas::create([
                'id_user' => Auth::user()->id,
                'aktivitas' => 'Memperbarui transaksi ID ' . $id,
                'waktu_aktivitas' => now()
            ]);

            DB::commit();
            return redirect()->route('petugas.transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('petugas.transaksi.index')->with('error', 'Transaksi gagal diperbarui.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Transaksi::findOrFail($id);
            $data->delete();

            return redirect()->route('petugas.transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
            } catch(\Exception $e) {
            return redirect()->route('petugas.transaksi.index')->with('error', 'Transaksi gagal dihapus.');

        }
    }
}
