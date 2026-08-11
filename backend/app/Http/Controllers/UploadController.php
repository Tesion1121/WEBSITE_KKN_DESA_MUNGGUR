<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->file('image')) {
            // Store the file in public/uploads directory
            $path = $request->file('image')->store('uploads', 'public');
            
            // Gunakan path relatif agar berfungsi di semua environment
            $url = '/storage/' . $path;

            return response()->json([
                'success' => true,
                'data' => [
                    'url' => $url
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal mengunggah file.'
        ], 400);
    }
}
