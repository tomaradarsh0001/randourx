<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\RoiRateController;
use App\Http\Controllers\DownlineController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\UserDashboardController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('member.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin login routes
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Admin dashboard - only accessible for admins
Route::get('/admindashboard', function () {
    return view('member.admindashboard');
})->middleware(['auth', 'admin'])->name('admindashboard');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function() {
    Route::resource('users', UserController::class);
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact-us', [HomeController::class, 'contact'])->name('contact');
Route::get('/rules', [HomeController::class, 'rules'])->name('rules');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/roi', [RoiRateController::class, 'index'])->name('roi.index');
    Route::post('/roi/{roiRate}/update', [RoiRateController::class, 'update'])->name('roi.update');
    Route::post('/roi/manual', [RoiRateController::class, 'manualProcess'])->name('roi.manual');

});

Route::get('/roi-history', [UserDashboardController::class, 'roiHistory'])
    ->name('roi.history');
Route::get('/my-investments', [UserDashboardController::class, 'investments'])
    ->name('user.investments');
Route::get('/my-incomes', [UserDashboardController::class, 'wallet2incomes'])
    ->name('user.income');
Route::get('/downlines', [DownlineController::class, 'index'])->name('downlines.index');
Route::post('/member/buy-package', [MemberController::class, 'buyPackage'])
    ->name('member.buyPackage')
    ->middleware('auth');
require __DIR__.'/auth.php';
