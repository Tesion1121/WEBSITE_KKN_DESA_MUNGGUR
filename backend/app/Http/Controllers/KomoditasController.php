<?php

namespace App\Http\Controllers;

use App\Models\Komoditas;
use Illuminate\Http\Request;

class KomoditasController extends Controller
{
    public function index()
    {
        $komoditas = Komoditas::all();
        return response()->json($komoditas);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'imageUrl' => 'nullable|string|max:2048',
            'image_url' => 'nullable|string|max:2048',
        ]);

        $imageUrl = $request->input('imageUrl') ?? $request->input('image_url') ?? null;

        $komoditas = Komoditas::create([
            'nama' => $validated['nama'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'image_url' => $imageUrl,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Komoditas berhasil ditambahkan!',
            'data' => $komoditas
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'imageUrl' => 'nullable|string|max:2048',
            'image_url' => 'nullable|string|max:2048',
        ]);

        $imageUrl = $request->input('imageUrl') ?? $request->input('image_url') ?? null;

        $komoditas = Komoditas::findOrFail($id);
        $komoditas->update([
            'nama' => $validated['nama'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'image_url' => $imageUrl,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Komoditas berhasil diperbarui!',
            'data' => $komoditas
        ]);
    }

    public function destroy($id)
    {
        $komoditas = Komoditas::findOrFail($id);
        $komoditas->delete();

        return response()->json([
            'success' => true,
            'message' => 'Komoditas berhasil dihapus!'
        ]);
    }
}
