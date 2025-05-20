<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Enquiry;
use App\Models\Feedback;
use App\Models\SurveyResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Metrics
        $metrics = [
            'totalUsers' => User::count(),
            'enquiriesReceived' => Enquiry::count(),
            'surveyResponses' => SurveyResponse::count(),
            'feedbackReceived' => Feedback::count(),
        ];

        // Start months from March (Mar)
        $now = Carbon::now();
        $months = collect();
        $start = $now->copy()->month < 3
            ? $now->copy()->subYear()->month(3)->startOfMonth()
            : $now->copy()->month(3)->startOfMonth();

        while ($months->count() < 6) {
            $months->push($start->format('M Y'));
            $start->addMonth();
        }

        // Enquiries trends
        $enquiriesTrends = Enquiry::select(
                DB::raw("DATE_FORMAT(created_at, '%b %Y') as month"),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', Carbon::parse($months->first())->startOfMonth())
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');
        $enquiriesData = $months->map(fn($m) => $enquiriesTrends[$m] ?? 0);

        // Survey responses trends
        $responsesTrends = SurveyResponse::select(
                DB::raw("DATE_FORMAT(submitted_at, '%b %Y') as month"),
                DB::raw('COUNT(*) as count')
            )
            ->where('submitted_at', '>=', Carbon::parse($months->first())->startOfMonth())
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');
        $responsesData = $months->map(fn($m) => $responsesTrends[$m] ?? 0);

        // User growth trends
        $userGrowthTrends = User::select(
                DB::raw("DATE_FORMAT(created_at, '%b %Y') as month"),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', Carbon::parse($months->first())->startOfMonth())
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');
        $userGrowthData = $months->map(fn($m) => $userGrowthTrends[$m] ?? 0);

        // Feedback trends
        $feedbackTrends = Feedback::select(
                DB::raw("DATE_FORMAT(created_at, '%b %Y') as month"),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', Carbon::parse($months->first())->startOfMonth())
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');
        $feedbackData = $months->map(fn($m) => $feedbackTrends[$m] ?? 0);

        return Inertia::render('Analytics/Index', [
            'metrics' => $metrics,
            'enquiriesTrends' => [
                'categories' => $months,
                'data' => $enquiriesData,
            ],
            'surveyResponsesTrends' => [
                'categories' => $months,
                'data' => $responsesData,
            ],
            'userGrowthTrends' => [
                'categories' => $months,
                'data' => $userGrowthData,
            ],
            'feedbackTrends' => [
                'categories' => $months,
                'data' => $feedbackData,
            ],
        ]);
    }
}
