<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\LoginLog;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // Points to your custom login form
    }

    public function login(Request $request)
    {
        try {
            // Validate the login request
            $this->validateLogin($request);

            // Attempt to log the user in
            if ($this->attemptLogin($request)) {
                // Log the login event
                $user = Auth::user();
                $user->is_logged_in = true;
                $user->save();

                $this->logEvent($user, 'login', $request);

                // Return a successful response with HTTP 200 status
                return response()->json([
                    'message' => 'Login successful',
                    'redirect' => '/home'
                ], 200);
            }

            // If login fails, return a custom error response
            return $this->sendFailedLoginResponse($request);

        } catch (\Exception $e) {
            // Log the error for debugging purposes
            \Log::error('Login failed: ' . $e->getMessage());

            // Return a server error response with HTTP 500 status
            return response()->json([
                'message' => 'An error occurred during login. Please try again later.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    protected function validateLogin(Request $request)
    {
        // Validate the login request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Log the user in manually
            Auth::login($user, $request->has('remember'));
            return true;
        }

        return false;
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        // Return a custom error response with HTTP 401 status
        return response()->json([
            'message' => 'Invalid credentials. Please check your email and password.',
        ], 401);
    }


    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            // Log the logout event
            $user->is_logged_in = false;
            $user->save();

            $this->logEvent($user, 'logout', $request);
        }

        Auth::logout();

        return redirect('/login/form');
    }

    // Log login or logout event to the database
    protected function logEvent(User $user, $event, Request $request)
    {
        LoginLog::create([
            'user_id' => $user->id,
            'event' => $event,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }
}
