<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    //
    public function showProfile()
    {
        // Fetch the first school profile
        $sekolah = Sekolah::first();

        // Check if the school profile exists
        if (!$sekolah) {
            $sekolah = "";
            // If no school profile exists, set a flash message to be shown with Toastify
            return view('sekolah.profile', compact('sekolah'))->with('error', 'School profile not found.');
        }

        // If school profile exists, pass it to the view
        return view('sekolah.profile', compact('sekolah'));
    }
    public function save(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'npsn' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'alamat' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Logo is optional
        ]);

        // Check if the school profile exists
        $sekolah = Sekolah::first();

        try {
            $data = $request->all();

            // Handle logo upload if provided
            if ($request->hasFile('logo')) {
                // Save the logo file and get its path
                $logoPath = $request->file('logo')->store('logos', 'public');
                $data['logo'] = $logoPath; // Add logo path to the data array
            } else {
                // Set logo to NULL if not provided
                $data['logo'] = null; // Or set a default path if you want
            }

            if ($sekolah) {
                $sekolah->update($data);
                $message = 'School profile updated successfully!';
            } else {
                Sekolah::create($data);
                $message = 'School profile created successfully!';
            }

            return redirect()->route('schoolprofile.index')->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while saving the profile: ' . $e->getMessage()])->withInput();
        }
    }
    public function getProfile()
{
    $schoolProfile = Sekolah::first(); // Adjust this based on your data structure
    return response()->json($schoolProfile);
}
}
