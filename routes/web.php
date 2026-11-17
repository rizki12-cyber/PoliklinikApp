<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ClinicProfileController;
use App\Http\Controllers\Admin\AdminAuthController;

// Landing Page Routes (Public)
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/article/{slug}', [LandingController::class, 'article'])->name('article.show');
Route::get('/doctors', [LandingController::class, 'getDoctors'])->name('doctors.index');
Route::get('/doctor-schedule/{doctorId}/{date}', [LandingController::class, 'getDoctorSchedule']);
Route::post('/booking', [LandingController::class, 'booking'])->name('booking.submit');
Route::get('/article/{slug}', [LandingController::class, 'article'])->name('article.show');
Route::get('/doctor-available-dates/{doctorId}', [LandingController::class, 'getAvailableDates'])->name('doctor.available.dates');

// Search di LandingPage
Route::get('/search-articles', [LandingController::class, 'searchArticles'])->name('search.articles');

// Route untuk booking
Route::post('/booking', [LandingController::class, 'booking'])->name('booking.submit');
Route::get('/booking/detail/{code}', [LandingController::class, 'showBookingDetail'])->name('booking.detail');

// Api
Route::post('/api/booking/{code}/cancel', [LandingController::class, 'cancelBooking']);

// Authentication Routes (default dari Laravel UI)
Auth::routes();

// Admin Routes - dengan middleware auth
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Services CRUD
    Route::resource('services', ServiceController::class);
    Route::post('/services/{service}/toggle-status', [ServiceController::class, 'toggleStatus'])->name('services.toggle-status');
    
    // Doctors CRUD
    Route::resource('doctors', DoctorController::class);
    Route::post('doctors/{doctor}/toggle-status', [DoctorController::class, 'toggleStatus'])->name('doctors.toggle-status');
    Route::post('/admin/doctors/{doctor}/toggle-status', [DoctorController::class, 'toggleStatus'])->name('doctors.toggle-status');
    
    // Bookings Management
    Route::get('bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::put('bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.update-status');
    Route::delete('bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    Route::get('bookings/export/excel', [BookingController::class, 'export'])->name('bookings.export');
    
    // Articles CRUD
    Route::resource('articles', ArticleController::class);
    Route::post('articles/upload-image', [ArticleController::class, 'uploadImage'])->name('articles.upload_image');
    Route::post('/articles/{article}/toggle-status', [ArticleController::class, 'toggleStatus'])
        ->name('articles.toggle-status');

    // Clinic Profile
    Route::get('clinic-profile', [ClinicProfileController::class, 'edit'])->name('clinic-profile.edit');
    Route::put('clinic-profile', [ClinicProfileController::class, 'update'])->name('clinic-profile.update');
});