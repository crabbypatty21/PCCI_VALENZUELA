<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        // Later, you'll replace this with a real database query like:
        // $members = Member::all();
        // return response()->json(['data' => $members], 200);

        return response()->json([
            'data' => [
                [
                    'company_name' => 'ABC Manufacturing Inc.',
                    'member_type' => 'Directory Member',
                    'status' => 'Active',
                    'business_address' => '123 Industry Road, Valenzuela City',
                    'email' => 'contact@abc.com.ph',
                    'contact_number' => '0917-123-4567',
                    'registered_member' => 'Juan Dela Cruz',
                    'created_at' => '2025-01-15T08:00:00.000000Z'
                ],
                [
                    'company_name' => 'XYZ Logistics Solutions',
                    'member_type' => 'Member',
                    'status' => 'Disabled',
                    'business_address' => '456 Warehouse Blvd, Valenzuela City',
                    'email' => 'info@xyzlogistics.com',
                    'contact_number' => '0918-987-6543',
                    'registered_member' => 'Maria Santos',
                    'created_at' => '2024-11-20T09:30:00.000000Z'
                ],
                [
                    'company_name' => 'Valenzuela Tech Group',
                    'member_type' => 'Member',
                    'status' => 'Active',
                    'business_address' => '789 Innovation Hub, Valenzuela City',
                    'email' => 'hello@valenzuelatech.ph',
                    'contact_number' => '0999-888-7777',
                    'registered_member' => 'Antonio Reyes',
                    'created_at' => '2026-02-10T14:15:00.000000Z'
                ]
            ]
        ], 200);
    }
}