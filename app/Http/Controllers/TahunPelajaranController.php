<?php

namespace App\Http\Controllers;

use App\Models\TahunPelajaran;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TahunPelajaranController extends Controller
{
    public function index()
    {
        return view('tahun-pelajaran.index'); // Create this view
    }

    public function data()
    {
        $tahunPelajarans = TahunPelajaran::select(['id', 'kode_tahun', 'tahun']);
        return DataTables::of($tahunPelajarans)
            ->addColumn('actions', function ($row) {
                return '<button class="btn btn-warning btn-sm edit-tahun" data-id="' . $row->id . '">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-danger btn-sm delete-tahun" data-id="' . $row->id . '">
                            <i class="fas fa-trash"></i> Delete
                        </button>';
            })
            ->rawColumns(['actions']) // Ensure that the actions column is rendered as HTML
            ->make(true);
    }

    public function store(Request $request)
    {
        // Validate and store data
        $request->validate([
            'kode_tahun' => 'required|max:10',
            'tahun' => 'required|max:125',
        ]);

        TahunPelajaran::updateOrCreate(
            ['id' => $request->id],
            $request->only(['kode_tahun', 'tahun'])
        );

        return response()->json(['success' => true, 'message' => 'Data saved successfully!']);
    }

    public function edit($id)
    {
        $tahunPelajaran = TahunPelajaran::find($id);
        return response()->json($tahunPelajaran);
    }

    public function destroy($id)
    {
        TahunPelajaran::destroy($id);
        return response()->json(['success' => true, 'message' => 'Data deleted successfully!']);
    }
}
