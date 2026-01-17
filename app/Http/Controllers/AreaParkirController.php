<?php

namespace App\Http\Controllers;

use App\Models\AreaParkir;
use Illuminate\Http\Request;

class AreaParkirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = AreaParkir::paginate(10);
        return view('admin.area_parkir.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.area_parkir.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_area' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:0',
            'terisi' => 'nullable|integer|min:0|max:' . $request->kapasitas
        ]);

        try{
            $validated['terisi'] = 0;
            $data = AreaParkir::create($validated);
            return redirect()->route('admin.area-parkir.index')->with('success', 'Area Parkir berhasil ditambahkan.');
            } catch(\Exception $e) {
            return redirect()->route('admin.area-parkir.index')->with('error', 'Area Parkir gagal ditambahkan.');

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
        $data = AreaParkir::findOrFail($id);
        return view('admin.area_parkir.update', [
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_area' => 'sometimes|string|max:255',
            'kapasitas' => 'sometimes|integer|min:0',
            'terisi' => 'sometimes|integer|min:0|max:' . $request->kapasitas ?? 1000000
        ]);

        try{
            $data = AreaParkir::findOrFail($id);
            $data->update($validated);
            return redirect()->route('admin.area-parkir.index')->with('success', 'Area Parkir berhasil ditambahkan.');
            } catch(\Exception $e) {
            return redirect()->route('admin.area-parkir.index')->with('error', 'Area Parkir gagal ditambahkan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = AreaParkir::findOrFail($id);
        try{
            $data->delete();
            return redirect()->route('admin.area-parkir.index')->with('success', 'Area Parkir berhasil dihapus.');
            } catch(\Exception $e) {
            return redirect()->route('admin.area-parkir.index')->with('error', 'Area Parkir gagal dihapus.');

        }
    }
}
