<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\FeedbackController; // Keep this one
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\SurveyQuestionController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\ProductController;


// Welcome page (public)
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('welcome');

// Authentication Routes
Route::get('/login', function () {
    return Inertia::render('Auth/Login');
})->name('login');

Route::get('/register', function () {
    return Inertia::render('Auth/Register');
})->name('register');

// Authenticated Dashboard
//Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
  //  return Inertia::render('Dashboard');
//})->name('dashboard');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});



// Enquiries - Only for logged-in users
Route::middleware(['auth'])->group(function () {
    //Route::resource('enquiries', EnquiryController::class);
    Route::get('/enquiries', [EnquiryController::class, 'index'])->name('enquiries.index');
    Route::get('/enquiries/create', [EnquiryController::class, 'create'])->name('enquiries.create');
    Route::post('/enquiries', [EnquiryController::class, 'store'])->name('enquiries.store');
    Route::get('/enquiries/{enquiry}/edit', [EnquiryController::class, 'edit'])->name('enquiries.edit');
    Route::put('/enquiries/{enquiry}', [EnquiryController::class, 'update'])->name('enquiries.update');
    Route::delete('/enquiries/{enquiry}', [EnquiryController::class, 'destroy'])->name('enquiries.destroy');
    Route::post('/enquiries/{enquiry}/assign', [EnquiryController::class, 'assign'])->name('enquiries.assign');
    Route::get('/enquiries/{enquiry}', [EnquiryController::class, 'show'])->name('enquiries.show');
});
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/enquiries', function () {
        return inertia('Enquiries/AdminDashboard');
    });
    Route::put('/api/enquiries/{id}', [EnquiryController::class, 'update']);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('feedback', FeedbackController::class); // Includes the 'destroy' route
    Route::post('/feedback/submit', [FeedbackController::class, 'submitFeedback'])->name('feedback.submit');
    Route::get('/feedback/own', [FeedbackController::class, 'viewOwnFeedback'])->name('feedback.own');
    Route::get('/feedback/view-all', [FeedbackController::class, 'viewFeedback'])->name('feedback.view');
});


Route::middleware(['auth'])->group(function () {
    Route::resource('surveys', SurveyController::class);
});
Route::middleware(['auth'])->group(function () {
    Route::resource('surveys.questions', SurveyQuestionController::class)->shallow();
});
Route::middleware(['auth'])->group(function () {
    Route::resource('tickets', TicketController::class);
});
Route::get('/test-role', function () {
    return 'You have the admin role!';
})->middleware('role:admin');

//Route::get('/manage-users', [UserController::class, 'index'])->name('manage-users');
//Route::middleware('auth')->group(function () {
  //  Route::resource('users', UserController::class);
//});
//Route::middleware(['auth', 'role:Admin'])->prefix('admin')->group(function () {
Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/{user}/assign-role', [UserController::class, 'assignRole'])->name('users.assignRole');
    Route::post('/users/{user}/revoke-role', [UserController::class, 'revokeRole'])->name('users.revokeRole');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');
    Route::get('/api/analytics/metrics', [AnalyticsController::class, 'metrics']);
    Route::get('/api/analytics/user-growth', [AnalyticsController::class, 'userGrowth']);
    Route::get('/api/analytics/feedback-trends', [AnalyticsController::class, 'feedbackTrends']);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class)->only(['index', 'create', 'store']);
});

// ✅ Authentication Routes
require __DIR__.'/auth.php';
