<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SolarProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Public marketing pages
Route::get('/', fn() => view('pages.home'))->name('home');
Route::get('/about', fn() => view('pages.about'))->name('about');
Route::get('/products', fn() => view('pages.products'))->name('products');
Route::get('/services', fn() => view('pages.services'))->name('services');
Route::get('/gallery', fn() => view('pages.gallery'))->name('gallery');
Route::get('/projects', fn() => view('pages.projects'))->name('projects');
Route::get('/contact', fn() => view('pages.contact'))->name('contact');

// Solar product catalog
Route::get('/solar-products', [SolarProductController::class, 'index'])->name('solar-products.index');
Route::get('/solar-products/{id}', [SolarProductController::class, 'show'])->name('solar-products.show');

// Unified portal entry: guests go to login, authenticated users go to their dashboard
Route::get('/portal', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    $user = auth()->user();

    return match ($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'channel_partner' => redirect()->route('partner.dashboard'),
        'employee' => redirect()->route('employee.dashboard'),
        'customer' => redirect()->route('customer.dashboard'),
        default => redirect()->route('home'),
    };
})->name('portal');

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Customer management
    Route::get('/customers', [App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/{customer}', [App\Http\Controllers\Admin\CustomerController::class, 'show'])->name('customers.show');
    Route::post('/kyc/{kyc}/approve', [App\Http\Controllers\Admin\CustomerController::class, 'approveKyc'])->name('kyc.approve');
    Route::post('/kyc/{kyc}/reject', [App\Http\Controllers\Admin\CustomerController::class, 'rejectKyc'])->name('kyc.reject');
    Route::post('/installation/{installation}/approve', [App\Http\Controllers\Admin\CustomerController::class, 'approveInstallation'])->name('installation.approve');
    Route::post('/installation/{installation}/reject', [App\Http\Controllers\Admin\CustomerController::class, 'rejectInstallation'])->name('installation.reject');
    Route::post('/loan/{loan}/approve', [App\Http\Controllers\Admin\CustomerController::class, 'approveLoan'])->name('loan.approve');
    Route::post('/loan/{loan}/reject', [App\Http\Controllers\Admin\CustomerController::class, 'rejectLoan'])->name('loan.reject');
    Route::post('/subsidy/{subsidy}/approve', [App\Http\Controllers\Admin\CustomerController::class, 'approveSubsidy'])->name('subsidy.approve');
    Route::post('/subsidy/{subsidy}/reject', [App\Http\Controllers\Admin\CustomerController::class, 'rejectSubsidy'])->name('subsidy.reject');

    // Loan management
    Route::post('/customers/{customer}/loan', [App\Http\Controllers\Admin\LoanController::class, 'store'])->name('loan.store');
    Route::put('/loan/{loan}', [App\Http\Controllers\Admin\LoanController::class, 'update'])->name('loan.update');

    // Installation management
    Route::post('/customers/{customer}/installation', [App\Http\Controllers\Admin\InstallationController::class, 'store'])->name('installation.store');
    Route::put('/installation/{installation}', [App\Http\Controllers\Admin\InstallationController::class, 'update'])->name('installation.update');

    // Subsidy management
    Route::post('/customers/{customer}/subsidy', [App\Http\Controllers\Admin\SubsidyController::class, 'store'])->name('subsidy.store');
    Route::put('/subsidy/{subsidy}', [App\Http\Controllers\Admin\SubsidyController::class, 'update'])->name('subsidy.update');

    // Packages
    Route::get('/packages', [App\Http\Controllers\Admin\PackageController::class, 'index'])->name('packages.index');
    Route::get('/packages/create', [App\Http\Controllers\Admin\PackageController::class, 'create'])->name('packages.create');
    Route::post('/packages', [App\Http\Controllers\Admin\PackageController::class, 'store'])->name('packages.store');
    Route::get('/packages/{package}/edit', [App\Http\Controllers\Admin\PackageController::class, 'edit'])->name('packages.edit');
    Route::put('/packages/{package}', [App\Http\Controllers\Admin\PackageController::class, 'update'])->name('packages.update');
    Route::post('/packages/{package}/toggle', [App\Http\Controllers\Admin\PackageController::class, 'toggleActive'])->name('packages.toggle');

    // Users
    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
    Route::post('/users', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    Route::post('/users/{user}/toggle', [App\Http\Controllers\Admin\UserController::class, 'toggleActive'])->name('users.toggle');

    // Attendance
    Route::get('/attendance', [App\Http\Controllers\Admin\AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance', [App\Http\Controllers\Admin\AttendanceController::class, 'store'])->name('attendance.store');

    // Tasks
    Route::get('/tasks', [App\Http\Controllers\Admin\TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [App\Http\Controllers\Admin\TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [App\Http\Controllers\Admin\TaskController::class, 'store'])->name('tasks.store');
    Route::put('/tasks/{task}', [App\Http\Controllers\Admin\TaskController::class, 'update'])->name('tasks.update');

    // Settings
    Route::get('/settings', [App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');

    // Quotations
    Route::get('/quotations', [App\Http\Controllers\Admin\QuotationController::class, 'index'])->name('quotations.index');
    Route::get('/quotations/create', [App\Http\Controllers\Admin\QuotationController::class, 'create'])->name('quotations.create');
    Route::post('/quotations', [App\Http\Controllers\Admin\QuotationController::class, 'store'])->name('quotations.store');
    Route::post('/quotations/{quotation}/send', [App\Http\Controllers\Admin\QuotationController::class, 'send'])->name('quotations.send');

    // Commissions
    Route::get('/commissions', [App\Http\Controllers\Admin\CommissionController::class, 'index'])->name('commissions.index');
    Route::get('/commissions/create', [App\Http\Controllers\Admin\CommissionController::class, 'create'])->name('commissions.create');
    Route::post('/commissions', [App\Http\Controllers\Admin\CommissionController::class, 'store'])->name('commissions.store');
    Route::put('/commissions/{commission}', [App\Http\Controllers\Admin\CommissionController::class, 'update'])->name('commissions.update');
    Route::post('/commissions/{commission}/pay', [App\Http\Controllers\Admin\CommissionController::class, 'markPaid'])->name('commissions.pay');

    // Payments
    Route::get('/payments', [App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('payments.index');
    Route::post('/payments', [App\Http\Controllers\Admin\PaymentController::class, 'store'])->name('payments.store');
});

// Channel Partner routes
Route::prefix('partner')->name('partner.')->middleware(['auth', 'role:channel_partner'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Partner\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/customers', [App\Http\Controllers\Partner\CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/create', [App\Http\Controllers\Partner\CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers', [App\Http\Controllers\Partner\CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/{customer}', [App\Http\Controllers\Partner\CustomerController::class, 'show'])->name('customers.show');
    Route::post('/customers/{customer}/kyc', [App\Http\Controllers\Partner\CustomerController::class, 'uploadKyc'])->name('customers.kyc');

    // Commissions
    Route::get('/commissions', [App\Http\Controllers\Partner\CommissionController::class, 'index'])->name('commissions.index');
});

// Employee routes
Route::prefix('employee')->name('employee.')->middleware(['auth', 'role:employee'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Employee\DashboardController::class, 'index'])->name('dashboard');
    Route::put('/tasks/{task}', [App\Http\Controllers\Employee\DashboardController::class, 'updateTask'])->name('tasks.update');
    Route::post('/checkin', [App\Http\Controllers\Employee\DashboardController::class, 'checkin'])->name('checkin');
    Route::post('/checkout', [App\Http\Controllers\Employee\DashboardController::class, 'checkout'])->name('checkout');
});

// Customer portal routes
Route::prefix('customer')->name('customer.')->middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Customer\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/pay', [App\Http\Controllers\Customer\PaymentController::class, 'create'])->name('payment.create');
    Route::post('/pay', [App\Http\Controllers\Customer\PaymentController::class, 'store'])->name('payment.store');
});
