<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use App\Models\BiayaSiswa;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Activitylog\Models\Activity;

class BiayaController extends Controller
{
    public function index()
    {
        return view('biayas.index');
    }

    public function data()
    {
        $data = Biaya::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $btn = '<button class="btn btn-warning btn-sm edit-biaya" data-id="' . $row->id . '">
                            <i class="fas fa-edit"></i> Edit
                        </button>';
                $btn .= '<button class="btn btn-danger btn-sm delete-biaya" data-id="' . $row->id . '">
                            <i class="fas fa-trash"></i> Delete
                        </button>';
                return $btn;
            })
            ->rawColumns(['actions']) // Ensure 'actions' column is treated as raw HTML
            ->make(true);
    }

    public function store(Request $request)
    {
        $id = $request->id;

        // Sanitize the 'jumlah' input by removing formatting (Rp. and periods)
        $request['jumlah'] = str_replace('.', '', str_replace('Rp. ', '', $request->jumlah));

        // Define validation rules
        $rules = [
            'kode_biaya' => 'required|string|max:255',
            'nama_biaya' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
        ];

        // Validate the request
        $request->validate($rules);

        try {
            if ($id) {
                // Update existing Biaya
                $biaya = Biaya::findOrFail($id);
                $biaya->update($request->only(['kode_biaya', 'nama_biaya', 'jumlah']));
                $message = 'Biaya updated successfully.';
            } else {
                // Create new Biaya
                Biaya::create($request->only(['kode_biaya', 'nama_biaya', 'jumlah']));
                $message = 'Biaya created successfully.';
            }

            return response()->json(['success' => true, 'message' => $message]);
        } catch (\Exception $e) {
            // Log the error message for debugging purposes
            \Log::error('Error saving Biaya: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Failed to save Biaya.']);
        }
    }

    public function edit($id)
    {
        try {
            $biaya = Biaya::findOrFail($id); // Use findOrFail to automatically throw an exception if not found
            return response()->json($biaya);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Biaya not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            Biaya::findOrFail($id)->delete();
            return response()->json(['success' => true, 'message' => 'Biaya deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete Biaya. Error: ' . $e->getMessage()], 500);
        }
    }

    public function showSiswaBiaya()
    {
        try {

            return view('biayas.siswa'); // Pass the data to the view
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to fetch Biaya Siswa. Error: ' . $e->getMessage()], 500);
        }
    }
    public function select(Request $request)
    {
        $biaya = Biaya::select('id', 'nama_biaya as text'); // Customize according to your model

        return response()->json($biaya->get());
    }

    public function biayaSiswa(Request $request)
    {
        try {
            // Validate the incoming request
            $validatedData = $request->validate([
                'siswa_id' => 'required|integer',
                'biaya_id' => 'required|integer',
                'jumlah' => 'required|numeric',
                'periode' => 'required|string',
                'tanggal_mulai' => 'required|date',
                'tanggal_akhir' => 'nullable|date',
                'status' => 'required|string',
                'is_angsur' => 'required|boolean',
                'jumlah_angsur' => 'nullable|numeric',
                'jumlah_angsuran_total' => 'nullable|numeric',
                'angsuran_terbayar' => 'nullable|numeric',
            ]);

            // Log the activity before saving

            // Save the data to the database
            $biayaSiswa = BiayaSiswa::create($validatedData);

            // Log the successful creation

            return response()->json(['message' => 'Biaya siswa berhasil disimpan!'], 201);
        } catch (Exception $e) {
            // Log the error
            dd($e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan biaya siswa.'], 500);
        }
    }

    // BiayaController.php
    public function showSiswaBiayaData()
    {
        // Fetch the BiayaSiswa data with related Biaya and Siswa data
        $biayas = BiayaSiswa::with(['biaya', 'siswa']);

        return DataTables::eloquent($biayas)
            ->addIndexColumn() // Adds the index column for the table
            ->addColumn('siswa_name', function ($biayaSiswa) {
                return $biayaSiswa->siswa->nama_lengkap;
            })
            ->addColumn('siswa_class', function ($biayaSiswa) {
                return $biayaSiswa->siswa->kelas->kelas; // Assuming the 'kelas' model has a 'kelas' attribute
            })
            ->addColumn('kode_biaya', function ($biayaSiswa) {
                return $biayaSiswa->biaya->kode_biaya;
            })
            ->addColumn('nama_biaya', function ($biayaSiswa) {
                return $biayaSiswa->biaya->nama_biaya;
            })
            ->addColumn('actions', function ($biayaSiswa) {
                return '<form method="POST" action="' . route('biayas.destroy', $biayaSiswa->id) . '">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>';
            })
            ->orderColumn('siswa_name', function ($query, $order) {
                $query->join('students', 'biaya_siswa.siswa_id', '=', 'students.id')
                    ->orderBy('students.nama_lengkap', $order);
            })
            ->rawColumns(['actions'])
            ->toJson();
    }
}
