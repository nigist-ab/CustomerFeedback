<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AnalyticsController extends Controller
{
    public function index()
    {
        return Inertia::render('Analytics/Index');
    }

    public function metrics()
    {
        return response()->json([
            'totalUsers' => 1234,
            'activeSessions' => 567,
            'feedbackReceived' => 89,
        ]);
    }

    public function userGrowth()
    {
        return response()->json([
            'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            'data' => [100, 200, 300, 400, 500],
        ]);
    }

    public function feedbackTrends()
    {
        return response()->json([
            'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            'data' => [10, 20, 15, 25, 30],
        ]);
    }
}
