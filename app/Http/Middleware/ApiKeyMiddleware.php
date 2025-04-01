<?php

namespace App\Http\Middleware;

use App\Helpers\V1\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('x-api-key');
        if (!$apiKey) {
            return ApiResponse::error('API key is required', 403); // Forbidden
        }

        // Check if the API key matches the environment variable or is in the companies table
        // $isValidApiKey = $apiKey === env('API_KEY') || DB::table('companies')->where('license_id', $apiKey)->exists();
        $isValidApiKey = $apiKey === env('API_KEY');

        if (!$isValidApiKey) {
            return ApiResponse::error('Invalid API key', 401); // Unauthorized
        }
        return $next($request);
    }
}
