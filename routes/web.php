<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChildsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route to redirect the user based on their authentication status
Route::get('/', function () {
    if (Auth::check()) {
        // Redirect to the dashboard if authenticated
        return redirect('/dashboard');
    } else {
        // Redirect to the login page if not authenticated
        return redirect('/login');
    }
});

// Group routes for guests (not authenticated users)
Route::middleware(['guest'])->group(function () {
    // Route to show the login form
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    // Route to handle the login form submission
    Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
});

// Group routes for authenticated users
Route::middleware(['auth'])->group(function () {
    // Route to show the dashboard
    Route::get('/dashboard', function(){
        return view('dashboard');
    })->name('dashboard');

    // Other routes accessible to authenticated users


    Route::get('/adhensions', function(){
        return "adhensions";
    })->name('adhensions');

    // Route to handle logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Group routes that require the user to be an admin
Route::middleware(['checkAdmin'])->group(function () {
    // Route to show the users list
    Route::get('/users', [UserController::class,'index'])->name('users');
    // Route to handle the user creation form submission
    Route::post('/users', [UserController::class, 'createUser'])->name('users.create');
    // Route to handle the user edit form submission
    Route::post('/users/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'disableUser'])->name('users.disableUser');

    //Route to show the orders list
    Route::get('/assurances', [OrderController::class,'index'])->name('assurances');
    Route::post('/updateOrderStatus', [OrderController::class,'updateOrderStatus'])->name('update.order.status');
    Route::post('/viewDetails', [OrderController::class,'viewDetails'])->name('viewDetails');
    Route::post('/generateOrderCertificate', [OrderController::class, 'generateOrderCertificate']);
    Route::get('/downloadPdf/{id}', [OrderController::class, 'downloadPdf']);

    //parents
    Route::get('/parents', [ParentController::class,'index'])->name('parents');
    Route::post('/parentViewDetails', [ParentController::class,'viewDetails'])->name('parentViewDetails');

    //enfants
    Route::get('/enfants', [ChildsController::class,'index'])->name('children');
    Route::post('/childViewDetails', [ChildsController::class,'viewDetails'])->name('childViewDetails');
});
