<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;


class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kendaraan::paginate(10);
        return view('admin.kendaraan.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kendaraan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'plat_nomor' => 'required|string|max:20',
            'jenis_kendaraan' => 'required|in:mobil,motor,lainnya',
            'warna' => 'required|string|max:50',
            'pemilik' => 'required|string',
            'id_user' => 'required|exists:users,id'
        ]);

        try{
            $data = Kendaraan::create($validated);
            return redirect()->route('admin.kendaraan.index')->with('success', 'Kendaraan berhasil ditambahkan.');
            } catch(\Exception $e) {
            return redirect()->route('admin.kendaraan.index')->with('error', 'Kendaraan gagal ditambahkan.');

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
        $data = Kendaraan::findOrFail($id);
        return view('admin.kendaraan.update', [
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'plat_nomor' => 'sometimes|string|max:20',
            'jenis_kendaraan' => 'sometimes|in:mobil,motor,lainnya',
            'warna' => 'sometimes|string|max:50',
            'pemilik' => 'sometimes|string',
            'id_user' => 'sometimes|exists:users,id'
        ]);

        try{
            $data = Kendaraan::findOrFail($id);
            $data->update($validated);
            return redirect()->route('admin.kendaraan.index')->with('success', 'Kendaraan berhasil diperbarui.');
            } catch(\Exception $e) {
            return redirect()->route('admin.kendaraan.index')->with('error', 'Kendaraan gagal diperbarui.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Kendaraan::findOrFail($id);
        try{
            $data->delete();
            return redirect()->route('admin.kendaraan.index')->with('success', 'Kendaraan berhasil dihapus.');
            } catch(\Exception $e) {
            return redirect()->route('admin.kendaraan.index')->with('error', 'Kendaraan gagal dihapus.');

        }
    }
}
