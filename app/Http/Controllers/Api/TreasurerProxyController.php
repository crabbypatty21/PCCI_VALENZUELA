<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TreasurerProxyController extends Controller
{
    public function processPayment(Request $request, $id)
    {
        $adminToken = config('services.pcci_api.admin_token');

        if (!$adminToken) {
            return response()->json([
                'message' => 'Admin API token not configured. Set PCCI_API_ADMIN_TOKEN in .env'
            ], 500);
        }

        $apiBase = config('services.pcci_api.base_url', 'https://pcci-laravel-api.onrender.com/api');

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $adminToken,
        ])->put("{$apiBase}/v1/applicants/{$id}", [
            'status' => 'paid',
            'membership_type_id' => $request->input('membership_type_id'),
        ]);

        return response()->json($response->json(), $response->status());
    }
}
