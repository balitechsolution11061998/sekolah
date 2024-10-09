<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        $roles = Role::all();
        return view('auth.registers', compact('roles'));
    }

    public function register(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'username' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Buat pengguna baru
            $user = User::create([
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'password_show' => $request->password,
                'password' => Hash::make($request->password),
            ]);

            // Cari role berdasarkan nama dan berikan ke pengguna
            $role = Role::where('name', $request->role)->first();
            if ($role) {
                // Menggunakan syncRoles() untuk sinkronisasi role
                $user->syncRoles([$role->name]);
            }

            // Login otomatis setelah register
            Auth::login($user);

            return response()->json([
                'message' => 'User  registered successfully',
                'status'=>200
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Merekam log kesalahan validasi ke database
            DB::table('logs')->insert([
                'message' => 'Error validating user input: ' . $e->getMessage(),
                'level' => 'error',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return response()->json(['error' => 'Validation error', 'message' => $e->getMessage()], 422);
        } catch (\Illuminate\Database\QueryException $e) {
            // Merekam log kesalahan database ke database
            DB::table('logs')->insert([
                'message' => 'Error querying database: ' . $e->getMessage(),
                'level' => 'error',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return response()->json(['error' => 'Database error', 'message' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            // Merekam log kesalahan umum ke database
            DB::table('logs')->insert([
                'message' => 'Error registering user: ' . $e->getMessage(),
                'level' => 'error',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return response()->json(['error' => 'Internal error', 'message' => $e->getMessage()], 500);
        }
    }
}
