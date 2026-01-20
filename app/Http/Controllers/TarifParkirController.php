<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifParkirController extends Controller
{
    public function index()
    {
        $tarifs = Tarif::paginate(10);
        return view('admin.tarif_parkir.index', [
            'tarifs' => $tarifs
        ]);
    }

    public function create()
    {
        return view('admin.tarif_parkir.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_kendaraan' => 'required|in:mobil,motor,lainnya',
            'tarif_per_jam' => 'required|numeric|min:0'
        ]);

        
        try {
            $data = Tarif::create($validated);
            return redirect()->route('admin.tarif-parkir.index')->with('success', 'Tarif Parkir berhasil ditambahkan.');
        } catch(\Exception $e) {
           return redirect()->route('admin.tarif-parkir.index')->with('error', 'Terjadi kesalahan saat menambahkan Tarif Parkir.');
        }
    }

    public function edit($id) {
        $tarif = Tarif::findOrFail($id);
        return view('admin.tarif_parkir.update', [
            'tarifParkir' => $tarif
        ]);
    }

    public function update(Request $request, $id) { 
        $validated = $request->validate([
            'jenis_kendaraan' => 'sometimes|in:mobil,motor,lainnya',
            'tarif_per_jam' => 'sometimes|numeric|min:0'
        ]);

        try {
            $data = Tarif::findOrFail($id);
            $data->update($validated);
            return redirect()->route('admin.tarif-parkir.index')->with('success', "Tarif Parkir berhasil diperbarui.");
        } catch(\Exception $e) {
            return redirect()->route('admin.tarif-parkir.index')->with('error', "Terjadi kesalahan saat memperbarui Tarif Parkir.");
        }
    }

    public function destroy($id) {
        try{
            $data = Tarif::findOrFail($id);
            $data->delete();
            return redirect()->route('admin.tarif-parkir.index')->with('success', 'Tarif Parkir berhasil dihapus.');
        } catch(\Exception $e) {
            return redirect()->route('admin.tarif-parkir.index')->with('error', 'Terjadi kesalahan saat menghapus Tarif Parkir.');
        }
    }
}
