<?php
namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Student;
use Illuminate\Http\Request;
use DataTables; // Import DataTables class

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch class levels from the 'kelas' table
        $kelas = Kelas::all(); // Adjust 'Kelas' to match your model name

        return view('students.index', compact('kelas'));
    }


    public function data(Request $request){
            $data = Student::select(['id', 'nama_lengkap', 'nisn', 'nik', 'tempat_lahir', 'tanggal_lahir', 'tingkat_rombel','no_telepon','status','foto_profile']);
            return Datatables::of($data)
                ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        // $request->validate([
        //     'nama_lengkap' => 'required|string|max:255',
        //     'nisn' => 'required|string|max:20',
        //     'nik' => 'required|string|max:20',
        //     'tempat_lahir' => 'required|string|max:100',
        //     'tanggal_lahir' => 'required|date',
        //     'tingkat_rombel' => 'required|string|max:100',
        //     'umur' => 'required|integer',
        //     'status' => 'required|string|max:50',
        //     'jenis_kelamin' => 'required|string|max:10',
        //     'alamat' => 'required|string',
        //     'no_telepon' => 'required|string|max:15',
        // ]);
        $data = [
            'nama_lengkap' => $request->input('nama_lengkap'),
            'nisn' => $request->input('nisn'),
            'nik' => $request->input('nik'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'tingkat_rombel' => $request->input('tingkat_rombel'),
            'umur' => $request->input('umur'),
            'status' => $request->input('status'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'alamat' => $request->input('alamat'),
            'no_telepon' => $request->input('no_telepon'),
            'kebutuhan_khusus' => $request->input('kebutuhan_khusus'),
            'disabilitas' => $request->input('disabilitas'),
            'nomor_kip_pip' => $request->input('nomor_kip_pip'),
            'nama_ayah' => $request->input('nama_ayah'),
            'nama_ibu' => $request->input('nama_ibu'),
            'nama_wali' => $request->input('nama_wali'),
        ];
        if ($request->has('profile_photo_url') && $request->input('profile_photo_url') != '') {
            $data['foto_profile'] = $request->input('profile_photo_url');
        }

        try {
            if ($request->id != null) {
                // Update existing student record
                $student = Student::findOrFail($request->input('id'));
                $student->update($data);

                // Return success response for update
                return response()->json([
                    'success' => true,
                    'message' => 'Student updated successfully.'
                ], 200); // HTTP status code 200 for successful update
            } else {
                // Insert a new student record
                Student::create($data);

                // Return success response for create
                return response()->json([
                    'success' => true,
                    'message' => 'Student created successfully.'
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
            $student = Student::findOrFail($id);
            return view('students.show', compact('student'));
        } catch (\Exception $e) {
            return redirect()->route('students.index')->with('error', 'Student not found.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $student = Student::findOrFail($id);

            // Return a JSON response with the student data and status code 200
            return response()->json([
                'success' => true,
                'data' => $student,
                'message' => 'Student data retrieved successfully.'
            ], 200);
        } catch (\Exception $e) {
            // Return a JSON response with an error message and status code 404
            return response()->json([
                'success' => false,
                'message' => 'Student not found.'
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
                'nisn' => 'required|string|max:20',
                'nik' => 'required|string|max:20',
                'tempat_lahir' => 'required|string|max:100',
                'tanggal_lahir' => 'required|date',
                'tingkat_rombel' => 'required|string|max:100',
                'umur' => 'required|integer',
                'status' => 'required|string|max:50',
                'jenis_kelamin' => 'required|string|max:10',
                'alamat' => 'required',
                'no_telepon' => 'required|string|max:15',
            ]);

            $student = Student::findOrFail($id);
            $student->update($request->all());

            return redirect()->route('students.index')->with('success', 'Student updated successfully.');
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
            $student = Student::findOrFail($id);
            $student->delete();

            return response()->json(['message' => 'Student deleted successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}
