<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BankController extends Controller
{
    public function index()
    {
        return view('banks.index');
    }

    public function data()
    {
        $data = Bank::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '
                    <button class="btn btn-warning btn-sm edit-bank" data-id="' . $row->id . '">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="btn btn-danger btn-sm delete-bank" data-id="' . $row->id . '">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function create()
    {
        return view('banks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sandi_bank' => 'required|string|max:20',
            'nama_bank' => 'required|string',
        ]);

        // Use updateOrCreate method to either update an existing bank or create a new one
        $bank = Bank::updateOrCreate(
            ['sandi_bank' => $request->sandi_bank], // Unique identifier
            [
                'nama_bank' => $request->nama_bank,
                'updated_at' => now(), // Update the timestamp
                'created_at' => now(), // Only set this if it's a new record; can also omit for existing records
            ]
        );

        return response()->json(['success' => true, 'message' => 'Bank processed successfully.', 'bank' => $bank]);
    }


    public function edit($id)
    {
        $bank = Bank::findOrFail($id);
        return response()->json($bank);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sandi_bank' => 'required|string|max:20',
            'nama_bank' => 'required|string',
        ]);

        $bank = Bank::findOrFail($id);
        $bank->update($request->all());

        return response()->json(['success' => true, 'message' => 'Bank updated successfully.']);
    }

    public function destroy($id)
    {
        Bank::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Bank deleted successfully.']);
    }
}
