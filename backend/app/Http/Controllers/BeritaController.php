<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * GET /api/berita
     * Daftar berita yang sudah dipublish, dengan pagination (10 per halaman).
     */
    public function index(Request $request)
    {
        $beritas = Berita::where('is_published', true)
            ->orderBy('tanggal_terbit', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json($beritas);
    }

    /**
     * GET /api/berita/{slug}
     * Detail satu berita berdasarkan slug.
     */
    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return response()->json($berita);
    }

    /**
     * POST /api/berita (Admin only)
     * Tambah berita baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'          => 'required|string|max:255',
            'isi'            => 'required|string',
            'ringkasan'      => 'nullable|string|max:500',
            'image_url'      => 'nullable|string|max:2048',
            'penulis'        => 'nullable|string|max:100',
            'tanggal_terbit' => 'nullable|date',
            'is_published'   => 'nullable|boolean',
        ]);

        $berita = Berita::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil ditambahkan!',
            'data'    => $berita,
        ], 201);
    }

    /**
     * PUT /api/berita/{id} (Admin only)
     * Edit berita.
     */
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'judul'          => 'required|string|max:255',
            'isi'            => 'required|string',
            'ringkasan'      => 'nullable|string|max:500',
            'image_url'      => 'nullable|string|max:2048',
            'penulis'        => 'nullable|string|max:100',
            'tanggal_terbit' => 'nullable|date',
            'is_published'   => 'nullable|boolean',
        ]);

        // Regenerate slug jika judul berubah
        if ($berita->judul !== $validated['judul']) {
            $validated['slug'] = Str::slug($validated['judul']) . '-' . time();
        }

        $berita->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil diupdate!',
            'data'    => $berita,
        ]);
    }

    /**
     * DELETE /api/berita/{id} (Admin only)
     * Hapus berita.
     */
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil dihapus.',
        ]);
    }

    /**
     * GET /api/admin/berita (Admin only)
     * Semua berita (termasuk draft) untuk admin panel.
     */
    public function adminIndex()
    {
        $beritas = Berita::orderBy('created_at', 'desc')->get();
        return response()->json($beritas);
    }
}
