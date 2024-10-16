<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Exception;
class UploadController extends Controller
{
    //
    public function upload(Request $request)
    {
        try {
            // Validate the incoming request
            $request->validate([
                'file' => 'required|image|max:2048', // 2MB Max
            ]);

            // Handle the uploaded file
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $path = $file->store('uploads', 'public'); // Store in the public disk

                // Return the file path to the client
                return response()->json(['filePath' => Storage::url($path)], 200);
            }

            return response()->json(['message' => 'No file uploaded'], 400);
        } catch (Exception $e) {
            // Handle any exceptions that may occur
            return response()->json(['message' => 'File upload failed', 'error' => $e->getMessage()], 500);
        }
    }
}
