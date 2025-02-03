<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next,  $role = null)
    {

        // Memastikan pengguna telah login
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to access this page.']);
        }


        // Mendapatkan user yang sedang login
        $user = Auth::user();

        if (!$user->role) {
            return redirect()->route('login')->withErrors(['error' => 'Your role is not recognized. Please sign in again.']);
        }

        // Jika tidak ada role yang diberikan pada parameter middleware, lakukan pengecekan berdasarkan role user
        if ($role) {
            if ($user->role !== $role) {
                return abort(403, 'Unauthorized access.');
            }
        } else {
            // Jika tidak ada role yang diberikan, arahkan berdasarkan role user
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard.get');
                case 'talent':
                    return redirect()->route('talent.dashboard.get');
                case 'writer':
                    return redirect()->route('writer.dashboard.get');
                case 'company':
                    return redirect()->route('company.dashboard.get');
                default:
                    return redirect()->route('login'); // Arahkan ke halaman default jika role tidak dikenali
            }
        }

        // Melanjutkan permintaan jika role sesuai
        return $next($request);
    }

}
