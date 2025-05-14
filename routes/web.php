<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\SurveyQuestionController;
use App\Http\Controllers\TicketController;

// Welcome page (public)
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('welcome');

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
});
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/enquiries', function () {
        return inertia('Enquiries/AdminDashboard');
    });
    Route::put('/api/enquiries/{id}', [EnquiryController::class, 'update']);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('feedback', FeedbackController::class);
});

// Customer: Submit feedback
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::post('/feedback', [FeedbackController::class, 'submitFeedback'])->name('feedback.submit');
    Route::get('/feedback/own', [FeedbackController::class, 'viewOwnFeedback'])->name('feedback.own');
});

// Admin/Agent: View feedback
Route::middleware(['auth', 'role:admin|agent'])->group(function () {
    Route::get('/feedback', [FeedbackController::class, 'viewFeedback'])->name('feedback.view');
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


// ✅ Authentication Routes
require __DIR__.'/auth.php';
