<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;

class KelasController extends Controller
{
    public function index()
    {
        $gurus = Guru::all();
        return view('kelas.index', compact('gurus'));
    }

    public function data()
    {
        $data = Kelas::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $btn = '<button class="btn btn-warning btn-sm edit-kelas" data-id="' . $row->id . '">
                            <i class="fas fa-edit"></i> Edit
                        </button>';
                $btn .= '<button class="btn btn-danger btn-sm delete-kelas" data-id="' . $row->id . '">
                            <i class="fas fa-trash"></i> Delete
                        </button>';
                return $btn;
            })
            ->rawColumns(['actions']) // Ensure 'actions' column is treated as raw HTML
            ->make(true);
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $id = $request->id;

        // Define validation rules
        $rules = [
            'kode_kelas' => 'required|string|unique:kelas,kode_kelas' . ($id ? ',' . $id : ''),
            'kelas' => 'nullable|string',
        ];

        // Validate the request
        $request->validate($rules);

        try {
            if ($id) {
                // Update existing Kelas
                $kelas = Kelas::findOrFail($id);
                $kelas->update($request->only(['kode_kelas', 'kelas']));
                $message = 'Kelas updated successfully.';
            } else {
                // Create new Kelas
                Kelas::create($request->only(['kode_kelas', 'kelas']));
                $message = 'Kelas created successfully.';
            }

            return response()->json(['success' => true, 'message' => $message]);
        } catch (\Exception $e) {
            // Log the error message for debugging purposes
            \Log::error('Error saving Kelas: ' . $e->getMessage());

            // Return the error message in the JSON response
            return response()->json(['success' => false, 'message' => 'Failed to save Kelas. Error: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        try {
            $kelas = Kelas::findOrFail($id); // Use findOrFail to automatically throw an exception if not found
            return response()->json($kelas);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Kelas not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            Kelas::findOrFail($id)->delete();
            // Return a JSON response indicating success
            return response()->json([
                'success' => true,
                'message' => 'Kelas deleted successfully.'
            ]);
        } catch (\Exception $e) {
            // Log the error message for debugging purposes

            // Return a JSON response indicating failure
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete Kelas. Error: ' . $e->getMessage()
            ], 500); // 500 Internal Server Error
        }
    }
}
