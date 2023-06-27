<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PageController;
use App\Http\Middleware\IsAuthenticated;
use App\Http\Middleware\IsNotAuthenticated;
use App\Http\Middleware\IsVerified;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", [PageController::class, "home"])->name('page.home');

// Route::get("/inventory", [ItemController::class, "index"])->name("item.index");
// Route::post("/inventory", [ItemController::class, "store"])->name("item.store");
// Route::get("/inventory/create", [ItemController::class, "create"])->name("item.create");
// Route::get("/inventory/{id}", [ItemController::class, "show"])->name("item.show");
// Route::get("/inventory/{id}/edit", [ItemController::class, "edit"])->name("item.edit");
// Route::delete("/inventory/{id}", [ItemController::class, "destory"])->name("item.destory");
// Route::put("/inventory/{id}", [ItemController::class, "update"])->name("item.update");


// Route::prefix("inventory")->controller(ItemController::class)->group(function () {
//     Route::get("/", "index")->name("item.index");
//     Route::post("/", "store")->name("item.store");
//     Route::get("/create", "create")->name("item.create");
//     Route::get("/{id}", "show")->name("item.show");
//     Route::get("/{id}/edit", "edit")->name("item.edit");
//     Route::delete("/{id}", "destory")->name("item.destory");
//     Route::put("/{id}", "update")->name("item.update");
// });




Route::middleware(IsAuthenticated::class)->group(function () {
    Route::resource("item", ItemController::class);

    Route::resource('category', CategoryController::class);
    Route::controller(HomeController::class)->prefix('dashboard')->group(function () {
        Route::get('home', 'home')->name('dashboard.home');
    });
});

Route::controller(AuthController::class)->group(function () {
    Route::middleware(IsNotAuthenticated::class)->group(function () {
        Route::get('register', 'register')->name("auth.register");
        Route::post('register', 'store')->name("auth.store");

        Route::get('login', 'login')->name("auth.login");
        Route::post('login', 'check')->name("auth.check");

        Route::get('forgot-password', 'forgotPassword')->name('auth.forgotPassword');
        Route::post('check-email', 'checkEmail')->name('auth.checkEmail');
        Route::get('new-password', 'newPassword')->name('auth.newPassword');
        Route::post('reset-password', 'resetPassword')->name('auth.resetPassword');
    });

    Route::middleware(IsAuthenticated::class)->group(function () {

        Route::get('logout', 'logout')->name("auth.logout");

        Route::middleware(IsVerified::class)->group(function () {
            Route::get('/password-change', 'passwordChange')->name('auth.passwordChange');
            Route::post('/password-change', 'passwordChanging')->name('auth.passwordChanging');
        });

        Route::get('/verify', 'verify')->name('auth.verify');
        Route::post('/verify', 'verifying')->name('auth.verifying');
    });
});
