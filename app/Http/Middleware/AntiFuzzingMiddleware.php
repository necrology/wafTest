<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class AntiFuzzingMiddleware
{
    public function handle(Request $request, Closure $next)
{
    $ip = $request->ip();
    $blockKey = 'banned_ip_' . $ip;
    $hitCountKey = 'hit_404_count_' . $ip;

    // 1. Cek apakah sudah diblokir
    if (Cache::has($blockKey)) {
        return response()->json(['message' => 'Your IP is temporarily banned.'], 403);
    }

    $response = $next($request);

    // 2. Jika request menghasilkan 404 (Halaman tidak ditemukan)
    if ($response->getStatusCode() === 404) {
        // Tambah hitungan 404 di Redis (berlaku selama 5 menit)
        $hits = Cache::increment($hitCountKey);
        Cache::put($hitCountKey, $hits, now()->addMinutes(5));

        // 3. Jika IP ini memicu lebih dari 10 kali 404 dalam 5 menit, blokir permanen/lama
        if ($hits >= 10) {
            Cache::put($blockKey, true, now()->addDays(1)); // Blokir 1 hari
            Log::warning("IP $ip otomatis diblokir karena serangan fuzzing/404.");
        }
    }

    return $response;
}
}