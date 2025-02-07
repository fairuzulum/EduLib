<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserManagementController;

// Landing Page
Route::get('/', [HomeController::class, 'index'])->name('landing-page');

// Authentication
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');

    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');

    Route::get('/register-librarian', 'showRegistrationFormLibrarian')->name('register.librarian');
    Route::post('/register-librarian', 'registerLibrarian');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

//Book
Route::get('/book/create', [BookController::class, 'create'])->middleware('auth')->name('book.create');

// Book Catalog
Route::prefix('book')->controller(BookController::class)->group(function () {
    Route::get('/catalog', 'index')->name('book.catalog');
    Route::get('/search', 'search')->name('book.search');
    Route::get('/{id}', 'show')->name('book.show');


    Route::middleware('auth')->group(function () {
        Route::post('/', 'store')->name('book.store');
        Route::get('/{id}/edit', 'edit')->name('book.edit');
        Route::put('/{id}', 'update')->name('book.update');
        Route::delete('/{id}', 'destroy')->name('book.delete');
        Route::post('/{id}/review', 'storeReview')->name('book.review');
    });
});

// Loan Routes
Route::middleware('auth')->group(function () {
    Route::middleware('role:member')->group(function () {
        Route::post('/loan/{bookId}', [LoanController::class, 'store'])->name('loan.store');
        Route::get('/loan-history', [LoanController::class, 'showLoanHistory'])->name('loan.history');
    });

    Route::middleware('role:librarian')->prefix('loans')->group(function () {
        Route::get('/', [LoanController::class, 'index'])->name('loan.index');
        Route::put('/return/{loanId}', [LoanController::class, 'returnBook'])->name('loan.return');
    });
});

// User Management (Librarian Only)
Route::middleware(['auth', 'role:librarian'])->prefix('users')->controller(UserManagementController::class)->group(function () {
    Route::get('/', 'index')->name('users.index');
    Route::get('/create', 'create')->name('users.create');
    Route::post('/', 'store')->name('users.store');
    Route::get('/{id}/edit', 'edit')->name('users.edit');
    Route::put('/{id}', 'update')->name('users.update');
    Route::delete('/{id}', 'destroy')->name('users.destroy');
});

// Profile Settings
Route::middleware('auth')->prefix('settings/profile')->controller(ProfileController::class)->group(function () {
    Route::get('/', 'edit')->name('profile.edit');
    Route::put('/', 'update')->name('profile.update');
    Route::post('/photo', 'updatePhoto')->name('profile.update.photo');
});

// Messages & Contact
Route::post('/contact', [MessageController::class, 'store'])->name('contact.store');
Route::post('/messages/mark-all-as-read', [MessageController::class, 'markAllAsRead'])->name('markAllMessagesAsRead');