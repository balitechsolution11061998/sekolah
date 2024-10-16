<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Retrieve all users who have the 'guru' role
        $gurus = User::whereHas('roles', function ($query) {
            $query->where('name', 'guru');
        })->get();

        // Pass the 'guru' users to the 'teachers.index' view
        return view('teachers.index', compact('gurus'));
    }


    public function data(Request $request)
    {
        $data = Guru::select(['id', 'nama_lengkap', 'gelar', 'nip', 'nuptk', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'avatar']);
        return Datatables::of($data)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guru.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $data = $request->validate([
            'user_id' => 'required|exists:users,id|unique:guru,user_id,' . $request->id,
            'nama_lengkap' => 'required|string|max:100',
            'gelar' => 'required|string|max:10',
            'nip' => 'nullable|string|max:18|unique:guru,nip,' . $request->id,
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:30',
            'tanggal_lahir' => 'required|date',
            'nuptk' => 'nullable|string|max:16|unique:guru,nuptk,' . $request->id,
            'alamat' => 'required|string',
        ]);

        try {
            // Handle the file upload
            if ($request->profile_photo_url) {
                $data['avatar'] = $request->profile_photo_url; // Save the URL in the database
            }

            if ($request->id != null) {
                // Update the existing Guru record
                $guru = Guru::findOrFail($request->input('id'));
                $guru->update($data);
                return response()->json(['success' => true, 'message' => 'Guru updated successfully.'], 200);
            } else {
                // Create a new Guru record
                Guru::create($data);
                return response()->json(['success' => true, 'message' => 'Guru created successfully.'], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $guru = Guru::findOrFail($id);
            return view('guru.show', compact('guru'));
        } catch (\Exception $e) {
            return redirect()->route('guru.index')->with('error', 'Guru not found.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $guru = Guru::findOrFail($id);
            return response()->json(['success' => true, 'data' => $guru, 'message' => 'Guru data retrieved successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Guru not found.'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'gelar' => 'required|string|max:10',
            'nip' => 'nullable|string|max:18|unique:guru,nip,' . $id,
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:30',
            'tanggal_lahir' => 'required|date',
            'nuptk' => 'nullable|string|max:16|unique:guru,nuptk,' . $id,
            'alamat' => 'required|string',
            'avatar' => 'required|string',
        ]);

        try {
            $guru = Guru::findOrFail($id);
            $guru->update($data);
            return redirect()->route('guru.index')->with('success', 'Guru updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $guru = Guru::findOrFail($id);
            $guru->delete();
            return response()->json(['message' => 'Guru deleted successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}
