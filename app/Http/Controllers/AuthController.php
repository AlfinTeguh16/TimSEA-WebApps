<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Talent;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('pages.auth.signIn');
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cek kredensial login
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'User not found.']);
        }

        // Login user
        Auth::login($user);

        // Debugging untuk memastikan role terbaca
        if (is_null($user->role)) {
            return redirect()->back()->withErrors(['error' => 'Role is not set or invalid.']);
        }

        // Redirect berdasarkan role
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard.get');
            case 'writer':
                return redirect()->route('writer.dashboard.get');
            case 'talent':
                return redirect()->route('talent.dashboard.get');
            case 'company':
                return redirect()->route('company.dashboard.get');
            default:
                Auth::logout(); // Logout user jika role tidak valid
                return redirect()->route('login')->withErrors(['error' => 'Invalid role']);
        }
    }

    /**
     * Logout user
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function postRegister(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:tb_users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:20',
            'field' => 'required|string|max:255',
            'profile_picture' => 'nullable|string',
            'linkedin' => 'nullable|string|url',
            'url_portfolio' => 'required|string|url',
        ]);

        // Password sudah divalidasi, lanjutkan proses registrasi
        DB::beginTransaction();

        try {
            $user = User::create([
                'username' => $validatedData['username'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'phone' => $validatedData['phone'],
                'role' => $validatedData['role'] ?? 'talent',
            ]);

            Talent::create([
                'id_users' => $user->id,
                'field' => $validatedData['field'],
                'profile_picture' => $validatedData['profile_picture'] ?? null,
                'linkedin' => $validatedData['linkedin'] ?? null,
                'url_portfolio' => $validatedData['url_portfolio'],
            ]);
            // DD($validatedData);

            DB::commit();

            return redirect()->route('register.success')->with(['type' => 'success', 'message' => 'User and Talent registered successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();

            logger()->error('Registration failed: ' . $e->getMessage());

            return back()->withErrors(['type' => 'error', 'message' => 'Registration failed. Please try again.']);
        }
    }

}
