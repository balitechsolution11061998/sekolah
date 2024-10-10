<?php
namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use DataTables; // Import DataTables class

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('teachers.index');
    }

    public function data(Request $request){
        $data = Guru::select(['id', 'nama_lengkap', 'nik', 'nuptk', 'status_kepegawaian', 'jenis_kelamin', 'tugas', 'penempatan', 'tanggal_lahir', 'nomor_handphone', 'email', 'foto_profile']);
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
        $data = [
            'nama_lengkap' => $request->input('nama_lengkap'),
            'nik' => $request->input('nik'),
            'nuptk' => $request->input('nuptk'),
            'status_kepegawaian' => $request->input('status_kepegawaian'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'tugas' => $request->input('tugas'),
            'penempatan' => $request->input('penempatan'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'nomor_handphone' => $request->input('nomor_handphone'),
            'email' => $request->input('email'),
            'email_madrasah' => $request->input('email_madrasah'),
            'password_awal' => $request->input('password_awal'),
        ];

        if ($request->has('profile_photo_url') && $request->input('profile_photo_url') != '') {
            $data['foto_profile'] = $request->input('profile_photo_url');
        }

        try {
            if ($request->id != null) {
                // Update existing guru record
                $guru = Guru::findOrFail($request->input('id'));
                $guru->update($data);

                // Return success response for update
                return response()->json([
                    'success' => true,
                    'message' => 'Guru updated successfully.'
                ], 200); // HTTP status code 200 for successful update
            } else {
                // Insert a new guru record
                Guru::create($data);

                // Return success response for create
                return response()->json([
                    'success' => true,
                    'message' => 'Guru created successfully.'
                ], 201); // HTTP status code 201 for created
            }
        } catch (\Exception $e) {
            // Return error response
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500); // HTTP status code 500 for internal server error
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

            // Return a JSON response with the guru data and status code 200
            return response()->json([
                'success' => true,
                'data' => $guru,
                'message' => 'Guru data retrieved successfully.'
            ], 200);
        } catch (\Exception $e) {
            // Return a JSON response with an error message and status code 404
            return response()->json([
                'success' => false,
                'message' => 'Guru not found.'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_lengkap' => 'required|string|max:255',
                'nik' => 'required|string|max:20',
                'nuptk' => 'required|string|max:20',
                'status_kepegawaian' => 'required|string|max:50',
                'jenis_kelamin' => 'required|string|max:10',
                'tugas' => 'required|string|max:100',
                'penempatan' => 'required|string|max:100',
                'tanggal_lahir' => 'required|date',
                'nomor_handphone' => 'required|string|max:15',
                'email' => 'required|email|max:255',
            ]);

            $guru = Guru::findOrFail($id);
            $guru->update($request->all());

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
