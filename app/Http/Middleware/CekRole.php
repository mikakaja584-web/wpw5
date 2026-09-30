<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class CekRole
{
   public function handle(Request $request, Closure $next, $role)
   {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        if ($request->user()->role !== $role) {
            return response()->json(['message' => 'Akses ditolak!'], 403);
        }
        return $next($request);
   }

   public function terminate($request, $response)
   {
       \Log::info('Request selesai', [
        'url' => $request->fullUrl(),
       ]);
   }
}
