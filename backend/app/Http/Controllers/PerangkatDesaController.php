<?php

namespace App\Http\Controllers;

use App\Models\PerangkatDesa;
use Illuminate\Http\Request;

class PerangkatDesaController extends Controller
{
    public function index()
    {
        $members = PerangkatDesa::all();
        return response()->json($members);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jabatan' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'imageUrl' => 'nullable|string|max:2048',
            'image_url' => 'nullable|string|max:2048',
        ]);

        $imageUrl = $request->input('imageUrl') ?? $request->input('image_url') ?? null;

        $member = PerangkatDesa::updateOrCreate(
            ['jabatan' => $validated['jabatan']],
            [
                'nama' => $validated['nama'],
                'image_url' => $imageUrl,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Perangkat desa berhasil disimpan!',
            'data' => $member
        ]);
    }

    public function resetAll()
    {
        $count = PerangkatDesa::count();
        PerangkatDesa::truncate();

        return response()->json([
            'success' => true,
            'message' => "Seluruh data perangkat desa ($count data) berhasil direset!",
        ]);
    }
}
