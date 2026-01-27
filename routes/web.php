<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\LifestyleController;
use App\Http\Controllers\ChamberController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\AdminResearchController;
use App\Http\Controllers\Admin\AdminChamberController;
use App\Http\Controllers\Admin\AdminAppointmentController;
use App\Http\Controllers\Admin\AdminLifestyleController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\Admin\AdminSliderController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Articles
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/category/{category}', [ArticleController::class, 'category'])->name('articles.category');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
// Public gallery routes
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/gallery/{category}', [GalleryController::class, 'category'])->name('gallery.category');
// Research
Route::get('/research', [ResearchController::class, 'index'])->name('research.index');

// Lifestyle
Route::get('/lifestyle', [LifestyleController::class, 'index'])->name('lifestyle.index');

// Chambers
Route::get('/chambers', [ChamberController::class, 'index'])->name('chambers.index');

// Appointments
Route::get('/book-appointment', [AppointmentController::class, 'create'])->name('appointment.create');
Route::post('/book-appointment', [AppointmentController::class, 'store'])->name('appointment.store');
Route::get('/appointment-success', [AppointmentController::class, 'success'])->name('appointment.success');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Admin Routes (Protected by auth middleware)
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Articles Management
    Route::resource('articles', AdminArticleController::class);

    // Research Management
    Route::resource('research', AdminResearchController::class);

    // Chambers Management
    Route::resource('chambers', AdminChamberController::class);
    Route::patch('chambers/{chamber}/toggle', [\App\Http\Controllers\Admin\AdminChamberController::class, 'toggle'])->name('chambers.toggle');

    // Appointments Management
    Route::get('appointments', [AdminAppointmentController::class, 'index'])->name('appointments.index');
    Route::get('appointments/export', [AdminAppointmentController::class, 'export'])->name('appointments.export');
    Route::post('appointments/bulk-action', [AdminAppointmentController::class, 'bulkAction'])->name('appointments.bulkAction');
    Route::get('appointments/{appointment}', [AdminAppointmentController::class, 'show'])->name('appointments.show');
    Route::patch('appointments/{appointment}/status', [AdminAppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');
    Route::delete('appointments/{appointment}', [AdminAppointmentController::class, 'destroy'])->name('appointments.destroy');

    // Lifestyle Management
    Route::resource('lifestyle', AdminLifestyleController::class);

    // Settings
    Route::get('settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [AdminSettingController::class, 'update'])->name('settings.update');

    // Doctor Profile Management
    Route::get('doctor-profile', [\App\Http\Controllers\Admin\AdminDoctorProfileController::class, 'index'])->name('doctor-profile.index');
    Route::post('doctor-profile/basic-info/{doctor}', [\App\Http\Controllers\Admin\AdminDoctorProfileController::class, 'updateBasicInfo'])->name('doctor-profile.updateBasicInfo');

    // Qualifications
    Route::post('doctor-profile/{doctor}/qualifications', [\App\Http\Controllers\Admin\AdminDoctorProfileController::class, 'storeQualification'])->name('doctor-profile.qualifications.store');
    Route::put('qualifications/{qualification}', [\App\Http\Controllers\Admin\AdminDoctorProfileController::class, 'updateQualification'])->name('doctor-profile.qualifications.update');
    Route::delete('qualifications/{qualification}', [\App\Http\Controllers\Admin\AdminDoctorProfileController::class, 'destroyQualification'])->name('doctor-profile.qualifications.destroy');

    // Work Experiences
    Route::post('doctor-profile/{doctor}/experiences', [\App\Http\Controllers\Admin\AdminDoctorProfileController::class, 'storeExperience'])->name('doctor-profile.experiences.store');
    Route::put('experiences/{experience}', [\App\Http\Controllers\Admin\AdminDoctorProfileController::class, 'updateExperience'])->name('doctor-profile.experiences.update');
    Route::delete('experiences/{experience}', [\App\Http\Controllers\Admin\AdminDoctorProfileController::class, 'destroyExperience'])->name('doctor-profile.experiences.destroy');

    // Specializations
    Route::post('doctor-profile/{doctor}/specializations', [\App\Http\Controllers\Admin\AdminDoctorProfileController::class, 'storeSpecialization'])->name('doctor-profile.specializations.store');
    Route::put('specializations/{specialization}', [\App\Http\Controllers\Admin\AdminDoctorProfileController::class, 'updateSpecialization'])->name('doctor-profile.specializations.update');
    Route::delete('specializations/{specialization}', [\App\Http\Controllers\Admin\AdminDoctorProfileController::class, 'destroySpecialization'])->name('doctor-profile.specializations.destroy');

    // Memberships
    Route::post('doctor-profile/{doctor}/memberships', [\App\Http\Controllers\Admin\AdminDoctorProfileController::class, 'storeMembership'])->name('doctor-profile.memberships.store');
    Route::put('memberships/{membership}', [\App\Http\Controllers\Admin\AdminDoctorProfileController::class, 'updateMembership'])->name('doctor-profile.memberships.update');
    Route::delete('memberships/{membership}', [\App\Http\Controllers\Admin\AdminDoctorProfileController::class, 'destroyMembership'])->name('doctor-profile.memberships.destroy');

    // Training Programs
    Route::post('doctor-profile/{doctor}/trainings', [\App\Http\Controllers\Admin\AdminDoctorProfileController::class, 'storeTraining'])->name('doctor-profile.trainings.store');
    Route::put('trainings/{training}', [\App\Http\Controllers\Admin\AdminDoctorProfileController::class, 'updateTraining'])->name('doctor-profile.trainings.update');
    Route::delete('trainings/{training}', [\App\Http\Controllers\Admin\AdminDoctorProfileController::class, 'destroyTraining'])->name('doctor-profile.trainings.destroy');

    // Admin gallery routes
    Route::get('/gallery', [AdminGalleryController::class, 'index'])->name('gallery.index');
    Route::get('/gallery/create', [AdminGalleryController::class, 'create'])->name('gallery.create');
    Route::post('/gallery', [AdminGalleryController::class, 'store'])->name('gallery.store');
    Route::get('/gallery/{gallery}/edit', [AdminGalleryController::class, 'edit'])->name('gallery.edit');
    Route::put('/gallery/{gallery}', [AdminGalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/{gallery}', [AdminGalleryController::class, 'destroy'])->name('gallery.destroy');
    Route::patch('/gallery/{gallery}/toggle-featured', [AdminGalleryController::class, 'toggleFeatured'])->name('gallery.toggleFeatured');

    // Slider routes

    Route::get('/sliders', [AdminSliderController::class, 'index'])->name('sliders.index');
    Route::get('/sliders/create', [AdminSliderController::class, 'create'])->name('sliders.create');
    Route::post('/sliders', [AdminSliderController::class, 'store'])->name('sliders.store');
    Route::get('/sliders/{slider}/edit', [AdminSliderController::class, 'edit'])->name('sliders.edit');
    Route::put('/sliders/{slider}', [AdminSliderController::class, 'update'])->name('sliders.update');
    Route::delete('/sliders/{slider}', [AdminSliderController::class, 'destroy'])->name('sliders.destroy');
    Route::patch('/sliders/{slider}/toggle-active', [AdminSliderController::class, 'toggleActive'])->name('sliders.toggleActive');


});

require __DIR__.'/auth.php';
