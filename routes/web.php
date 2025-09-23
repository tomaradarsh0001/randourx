<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\RoiRateController;
use App\Http\Controllers\DownlineController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\SalaryIncomeController;

use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


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
Route::get('/admin/dashboard', function () {
    $pendingCount = \App\Models\Transaction::pending()->count();
    $approvedCount = \App\Models\Transaction::approved()->count();
    $rejectedCount = \App\Models\Transaction::rejected()->count();
    $totalUsers = \App\Models\User::count();
    $recentTransactions = \App\Models\Transaction::with('user')
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
    
    return view('member.admindashboard', compact(
        'pendingCount', 
        'approvedCount', 
        'rejectedCount',
        'totalUsers',
        'recentTransactions'
    ));
})->middleware(['auth', 'admin'])->name('admindashboard');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function() {
    Route::resource('users', UserController::class);
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function (Request $request) {
    if ($request->has('ref')) {
        // store sponsor username in session
        session(['sponsor' => $request->get('ref')]);
        return redirect()->route('register'); // redirect to register page
    }

    return view('welcome'); // your homepage
});Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact-us', [HomeController::class, 'contact'])->name('contact');
Route::get('/rules', [HomeController::class, 'rules'])->name('rules');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::post('/forgot-password-now', [ForgotPasswordController::class, 'resetPassword'])
    ->name('forgot.password');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/roi', [RoiRateController::class, 'index'])->name('roi.index');
    Route::post('/roi/{roiRate}/update', [RoiRateController::class, 'update'])->name('roi.update');
    Route::post('/roi/manual', [RoiRateController::class, 'manualProcess'])->name('roi.manual');

});

 Route::prefix('transactions')->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('member.transactions.index');
        Route::get('/deposit', [TransactionController::class, 'createDeposit'])->name('member.transactions.deposit');
        Route::post('/deposit', [TransactionController::class, 'storeDeposit'])->name('member.transactions.deposit.store');
        Route::get('/withdraw', [TransactionController::class, 'createWithdrawal'])->name('member.transactions.withdraw');
        Route::post('/withdraw', [TransactionController::class, 'storeWithdrawal'])->name('member.transactions.withdraw.store');
    });

    // Admin routes
Route::prefix('admin')->middleware([ 'admin'])->group(function () {
    // Transactions
    Route::prefix('transactions')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('admin.transactions.index');
        Route::get('/pending', [App\Http\Controllers\Admin\TransactionController::class, 'pending'])->name('admin.transactions.pending');
        Route::get('/{transaction}', [App\Http\Controllers\Admin\TransactionController::class, 'show'])->name('admin.transactions.show');
        Route::post('/{transaction}/approve', [App\Http\Controllers\Admin\TransactionController::class, 'approve'])->name('admin.transactions.approve');
        Route::post('/{transaction}/reject', [App\Http\Controllers\Admin\TransactionController::class, 'reject'])->name('admin.transactions.reject');
    });
});

Route::get('/roi-history', [UserDashboardController::class, 'roiHistory'])
    ->name('roi.history');
Route::get('/my-investments', [UserDashboardController::class, 'investments'])
    ->name('user.investments');
Route::get('/my-incomes', [UserDashboardController::class, 'wallet2incomes'])
    ->name('user.income');
Route::get('/member/commissions/export', [MemberController::class, 'exportCommissions'])->name('member.commissions.export');
Route::get('/level-incomes', [MemberController::class, 'levelCommissions'])->name('member.wallets.level');
Route::get('/deposits', [UserDashboardController::class, 'depositHistory'])->name('member.deposit.history');
// OR if you want to use a separate controller
Route::get('/downlines', [DownlineController::class, 'index'])->name('downlines.index');
Route::post('/member/buy-package', [MemberController::class, 'buyPackage'])
    ->name('member.buyPackage')
    ->middleware('auth');
        Route::get('/salary', [SalaryIncomeController::class, 'index'])->name('salary.index');

require __DIR__.'/auth.php';

