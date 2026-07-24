<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function index()
    {
        $umkms = Umkm::orderBy('created_at', 'desc')->get();
        return response()->json($umkms);
    }

    public function show($id)
    {
        $umkm = Umkm::findOrFail($id);
        return response()->json($umkm);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'alamat' => 'nullable|string',
            'harga' => 'nullable|string|max:255',
            'kontak' => 'required|string|max:255',
            'imageUrl' => 'nullable|string|max:2048',
            'image_url' => 'nullable|string|max:2048',
        ]);

        $imageUrl = $request->input('imageUrl') ?? $request->input('image_url') ?? null;
        $validated['image_url'] = $imageUrl;
        unset($validated['imageUrl']);

        $umkm = Umkm::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'UMKM berhasil ditambahkan!',
            'data' => $umkm
        ], 201); // Standard 201 Created
    }

    public function update(Request $request, $id)
    {
        $umkm = Umkm::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'alamat' => 'nullable|string',
            'harga' => 'nullable|string|max:255',
            'kontak' => 'required|string|max:255',
            'imageUrl' => 'nullable|string|max:2048',
            'image_url' => 'nullable|string|max:2048',
        ]);

        $imageUrl = $request->input('imageUrl') ?? $request->input('image_url') ?? null;
        $validated['image_url'] = $imageUrl;
        unset($validated['imageUrl']);

        $umkm->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'UMKM berhasil diupdate!',
            'data' => $umkm
        ]);
    }

    public function destroy($id)
    {
        $umkm = Umkm::findOrFail($id);
        $umkm->delete();

        return response()->json([
            'success' => true,
            'message' => 'UMKM berhasil dihapus.'
        ]);
    }
}
