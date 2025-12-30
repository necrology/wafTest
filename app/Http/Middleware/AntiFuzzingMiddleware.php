<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class AntiFuzzingMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $userAgent = $request->header('User-Agent');
        $ip = $request->ip();
        $cacheKey = 'banned_ip_' . $ip;

        // 1. Cek apakah IP ini sudah masuk daftar blokir sementara
        if (Cache::has($cacheKey)) {
            return response()->json(['message' => 'Access Denied'], 403);
        }

        // 2. Deteksi User-Agent ffuf atau tools populer lainnya
        if (str_contains($userAgent, 'Fuzz Faster U Fool') || str_contains($userAgent, 'ffuf')) {
            // Blokir IP selama 24 jam karena terdeteksi menggunakan alat penyerang
            Cache::put($cacheKey, true, now()->addDay());
            return response()->json(['message' => 'Security Triggered'], 403);
        }

        // 3. Deteksi pola URL mencurigakan (Honeypot)
        if ($request->is('wafTest*') || $request->is('*.env') || $request->is('wp-admin*')) {
            Cache::put($cacheKey, true, now()->addDay());
            return response()->json(['message' => 'Target not found'], 404);
        }

        return $next($request);
    }
}