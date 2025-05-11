<?php

declare(strict_types=1);

namespace App\Http\Middleware\API\Subscription;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SignUpAccessCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->isIpAddressBlacklisted($request->ip())) {
            return response()->json([
                'status' => 'error',
                'message' => 'Your IP address is blacklisted.',
            ], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }

    /**
     * Checks if the provided IP address is blacklisted.
     *
     * @param  string  $ip  The IP address to check.
     * @return bool Returns true if the IP address is blacklisted, otherwise false.
     */
    private function isIpAddressBlacklisted(string $ip): bool
    {
        // @todo #hardcode
        $blockedIPs = ['192.168.1.1'];

        return in_array($ip, $blockedIPs, true);
    }
}
