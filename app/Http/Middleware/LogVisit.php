<?php

namespace App\Http\Middleware;

use App\Models\Visit;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ipAddress = $request->ip();
        $recentVisit = Visit::where('ip_address', $ipAddress)
                            ->where('visited_at', '>=', Carbon::now()->subMinutes(15))
                            ->first();

        if (!$recentVisit) {
            Visit::create([
                'ip_address' => $ipAddress,
                'visited_at' => now(),
            ]);
        }
        return $next($request);
    }
}
