<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeadershipController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => [
                [
                    'id' => 1,
                    'firstname' => 'Jundio',
                    'lastname' => 'Salvador',
                    'position' => ['position' => 'President'], 
                    'company_name' => 'ABC Manufacturing Inc.',
                    'image_url' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=400'
                ],
                [
                    'id' => 2,
                    'firstname' => 'Maria',
                    'lastname' => 'Santos',
                    'position' => ['position' => 'Vice President'], 
                    'company_name' => 'XYZ Logistics Solutions',
                    'image_url' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=400'
                ],
                [
                    'id' => 3,
                    'firstname' => 'Antonio',
                    'lastname' => 'Reyes',
                    'position' => ['position' => 'Secretary'], 
                    'company_name' => 'Reyes Construction',
                    'image_url' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=400'
                ],
                [
                    'id' => 4,
                    'firstname' => 'Elena',
                    'lastname' => 'Bautista',
                    'position' => ['position' => 'Treasurer'], 
                    'company_name' => 'EB Financial Services',
                    'image_url' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=400'
                ]
            ]
        ], 200);
    }
}