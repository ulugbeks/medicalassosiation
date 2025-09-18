<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // Create a unique filename
            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            
            // Store in the uploads directory
            $path = $image->storeAs('uploads', $filename, 'public');
            
            // For shared hosting, we'll use both approaches to maximize compatibility
            // 1. Standard storage URL if symlink works
            $url = asset('storage/' . $path);
            
            // 2. Fallback URL that uses a direct path if needed
            // Uncomment this if the symlink approach doesn't work
            // $url = url('uploads/' . $filename);
            
            return response()->json([
                'success' => true,
                'url' => $url
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Image upload failed'
        ], 400);
    }

    
    public function uploadDirect(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            
            // Store directly in the public directory
            $image->move(public_path('images/uploads'), $filename);
            
            // Set the correct URL
            $url = 'images/uploads/' . $filename;
            
            return response()->json([
                'success' => true,
                'url' => $url
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Image upload failed'
        ], 400);
    }
}