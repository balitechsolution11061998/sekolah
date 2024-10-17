<?php
namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\TahunPelajaran;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MapelController extends Controller
{
    public function index()
    {
        $tapels = TahunPelajaran::all(); // Fetch all tapel records
        return view('mapels.index',compact('tapels')); // Return the view for displaying the table
    }

    public function data()
    {
        $mapels = Mapel::with('tapel') // Eager load the tapel relationship
            ->select(['mapel.id', 'tapel_id', 'nama_mapel', 'ringkasan_mapel']);

        return DataTables::of($mapels)
            ->addColumn('actions', function ($row) {
                return '<button class="btn btn-warning btn-sm edit-mapel" data-id="' . $row->id . '"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm delete-mapel" data-id="' . $row->id . '"><i class="fas fa-trash"></i></button>';
            })
            ->addColumn('tapel', function ($row) {
                return $row->tapel ? $row->tapel->kode_tahun . ' - ' . $row->tapel->tahun : 'N/A'; // Display tapel details
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $mapel = Mapel::updateOrCreate(
            ['id' => $request->id],
            $request->only('tapel_id', 'nama_mapel', 'ringkasan_mapel')
        );

        return response()->json(['success' => true, 'message' => 'Mapel saved successfully!']);
    }

    public function edit($id)
    {
        $mapel = Mapel::find($id);
        return response()->json($mapel);
    }

    public function update(Request $request, $id)
    {
        $mapel = Mapel::find($id);
        $mapel->update($request->only('tapel_id', 'nama_mapel', 'ringkasan_mapel'));
        return response()->json(['success' => true, 'message' => 'Mapel updated successfully!']);
    }

    public function destroy($id)
    {
        Mapel::destroy($id);
        return response()->json(['success' => true, 'message' => 'Mapel deleted successfully!']);
    }
}
