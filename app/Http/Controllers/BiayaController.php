<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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
}
