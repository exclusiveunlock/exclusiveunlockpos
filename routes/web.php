<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FirmwareController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\RecentFilesController;
use App\Http\Controllers\PasswordAccessController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\StatementController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\FundController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\Google2FAController;
use App\Http\Controllers\PinVerificationController;
use App\Http\Controllers\ShippingAddressController;
use App\Http\Controllers\UserApiController;
use App\Http\Controllers\UserPreferenceController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ResellerController;
use App\Http\Controllers\ResellerDashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CronController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\DhruFusionWebhookController;
use App\Http\Controllers\GsmxpayController;
use App\Http\Controllers\UpdatePageController;
use App\Http\Controllers\CurrencyController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/currency/switch', [HomeController::class, 'switchCurrency'])->name('currency.switch');

// Pages CMS
Route::get('/page/{slug}', [PageController::class, 'show'])->name('pages.show');

// News
Route::get('/news',             [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news:slug}', [NewsController::class, 'show'])->name('news.show');

// Packages (público)
Route::get('/packages',           [PackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{package}', [PackageController::class, 'show'])->name('packages.show');

// Recent Files (público)
Route::get('/recent-files', [RecentFilesController::class, 'index'])->name('recent-files');

// Password Access (público)
Route::get('/password-access', [PasswordAccessController::class, 'index'])->name('password.access.index');

// Store (público)
Route::get('/store',           [StoreController::class, 'index'])->name('store.index');
Route::get('/store/{product}', [StoreController::class, 'show'])->name('store.show');

// Firmware (público)
Route::prefix('firmware')->name('firmware.')->group(function () {

    Route::get('/', [FirmwareController::class, 'index'])->name('index');

    // Estáticas — siempre antes del parámetro dinámico
    Route::get('/search',          [FirmwareController::class, 'search'])->name('search');
    Route::get('/featured',        [FirmwareController::class, 'featured'])->name('featured');
    Route::get('/paid',            [FirmwareController::class, 'paid'])->name('paid');
    Route::get('/free',            [FirmwareController::class, 'free'])->name('free');
    Route::get('/most-downloaded', [FirmwareController::class, 'mostDownloaded'])->name('most-downloaded');
    Route::get('/most-viewed',     [FirmwareController::class, 'mostViewed'])->name('most-viewed');
    Route::get('/recent',          [FirmwareController::class, 'recent'])->name('recent');

    // Filtros por relación
    Route::get('/by-folder/{folder:slug}', [FirmwareController::class, 'byFolder'])->name('by-folder');
    Route::get('/by-tag/{tag:slug}',       [FirmwareController::class, 'byTag'])->name('by-tag');

    // Dinámicas — siempre AL FINAL
    Route::get('/{firmware:slug}',          [FirmwareController::class, 'show'])->name('show');
    Route::get('/{firmware:slug}/download', [FirmwareController::class, 'download'])->name('download');
    Route::get('/{firmware}/report',        [ReportController::class, 'create'])->name('report.create');
});

// Folders (público)
Route::get('/folders/{folder:slug}', [FolderController::class, 'show'])->name('folders.show');

// Cron (protegido por token dentro del controlador)
Route::get('/cron/run', [CronController::class, 'run'])->name('cron.run');

// Webhooks externos (sin auth de sesión)
Route::post('/webhook/dhru-fusion', [DhruFusionWebhookController::class, 'handle'])->name('webhook.dhru-fusion');
Route::post('/webhook/gsmxpay',     [GsmxpayController::class, 'webhook'])->name('webhook.gsmxpay');

/*
|--------------------------------------------------------------------------
| 2FA Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/2fa',          [Google2FAController::class, 'show'])->name('2fa.show');
    Route::post('/2fa',         [Google2FAController::class, 'verify'])->name('2fa.verify');
    Route::get('/2fa/setup',    [Google2FAController::class, 'setup'])->name('2fa.setup');
    Route::post('/2fa/enable',  [Google2FAController::class, 'enable'])->name('2fa.enable');
    Route::post('/2fa/disable', [Google2FAController::class, 'disable'])->name('2fa.disable');
});

/*
|--------------------------------------------------------------------------
| PIN Verification
|--------------------------------------------------------------------------
*/
Route::put('/profile/preferences', [ProfileController::class, 'updatePreferences'])->name('profile.preferences.update');
Route::middleware(['auth'])->group(function () {
    Route::get('/pin',         [PinVerificationController::class, 'show'])->name('pin.show');
    Route::post('/pin/verify', [PinVerificationController::class, 'verify'])->name('pin.verify');
    Route::post('/pin/set',    [PinVerificationController::class, 'set'])->name('pin.set');
    Route::post('/pin/reset',  [PinVerificationController::class, 'reset'])->name('pin.reset');
});

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
Route::get('/store/order/tracking', [ShippingAddressController::class, 'trackingForm'])->name('store.order.tracking');
Route::post('/store/order/tracking', [ShippingAddressController::class, 'trackOrder'])->name('store.order.tracking.post');
    // Profile Breeze
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Profile extendido
    Route::get('/user/profile',  [UserProfileController::class, 'index'])->name('user.profile');
    Route::post('/user/profile', [UserProfileController::class, 'update'])->name('user.profile.update');

    // Preferencias
    Route::get('/user/preferences',  [UserPreferenceController::class, 'index'])->name('user.preferences');
    Route::post('/user/preferences', [UserPreferenceController::class, 'update'])->name('user.preferences.update');

    // Cambiar contraseña
    Route::get('/password/edit', [PasswordController::class, 'edit'])->name('password.edit');
    Route::put('/password',      [PasswordController::class, 'update'])->name('password.update');

    // Password Access (autenticado)
    Route::get('/password-access/request',  [PasswordAccessController::class, 'create'])->name('password.access.create');
    Route::post('/password-access/request', [PasswordAccessController::class, 'store'])->name('password.access.store');
    Route::get('/password-access/{id}',     [PasswordAccessController::class, 'show'])->name('password.access.show');

    // Statement / Estado de cuenta
    Route::get('/statement',        [StatementController::class, 'index'])->name('user.statement');
    Route::get('/statement/export', [StatementController::class, 'export'])->name('user.statement.export');

    // Reports
    Route::get('/reports',          [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/create',   [ReportController::class, 'create'])->name('reports.create');
    Route::post('/reports',         [ReportController::class, 'store'])->name('reports.store');
    Route::get('/reports/{report}', [ReportController::class, 'show'])->name('reports.show');

    // Store / Orders (autenticado)
    Route::post('/store/{product}/order', [StoreController::class, 'order'])->name('store.order');
    Route::get('/orders',                 [StoreController::class, 'orders'])->name('orders.index');
    Route::get('/orders/{order}',         [StoreController::class, 'orderShow'])->name('orders.show');

    // Funds / Wallet
    Route::get('/funds',                     [FundController::class, 'index'])->name('funds.index');
    Route::get('/funds/add',                 [FundController::class, 'create'])->name('funds.create');
    Route::get('/funds/add',                 [FundController::class, 'create'])->name('funds.add.form');
    Route::post('/funds/add',                [FundController::class, 'store'])->name('funds.add');
    Route::get('/funds/history',             [FundController::class, 'history'])->name('funds.history');
    Route::get('/funds/callback/{gateway}',  [FundController::class, 'callback'])->name('funds.callback');
    Route::post('/funds/callback/{gateway}', [FundController::class, 'callbackPost'])->name('funds.callback.post');
Route::post('/firmware/{firmware}/report', [FirmwareReportController::class, 'store'])->name('firmware.report.store');
    // Tickets
    Route::get('/tickets',                  [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create',           [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets',                 [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}',         [TicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{ticket}/reply',  [TicketController::class, 'reply'])->name('tickets.reply');
    Route::patch('/tickets/{ticket}/close', [TicketController::class, 'close'])->name('tickets.close');

    // Shipping Address
    Route::resource('shipping-addresses', ShippingAddressController::class);

    // Security
    Route::get('/security',         [SecurityController::class, 'index'])->name('security.index');
    Route::post('/security/update', [SecurityController::class, 'update'])->name('security.update');

    // API Keys del usuario
    Route::get('/api-keys',           [UserApiController::class, 'index'])->name('api.keys.index');
    Route::post('/api-keys/generate', [UserApiController::class, 'generate'])->name('api.keys.generate');
    Route::delete('/api-keys/{key}',  [UserApiController::class, 'destroy'])->name('api.keys.destroy');

    // GsmXPay
    Route::get('/gsmxpay',      [GsmxpayController::class, 'index'])->name('gsmxpay.index');
    Route::post('/gsmxpay/pay', [GsmxpayController::class, 'pay'])->name('gsmxpay.pay');

    // Packages — activar
    Route::post('/packages/{package}/activate', [PackageController::class, 'activate'])->name('packages.activate');
});

/*
|--------------------------------------------------------------------------
| Reseller Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'reseller'])->prefix('reseller')->name('reseller.')->group(function () {
    Route::get('/dashboard',        [ResellerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/customers',        [ResellerController::class, 'customers'])->name('customers');
    Route::get('/customers/{user}', [ResellerController::class, 'customerShow'])->name('customers.show');
    Route::get('/orders',           [ResellerController::class, 'orders'])->name('orders');
    Route::get('/funds',            [ResellerController::class, 'funds'])->name('funds');
    Route::post('/funds/transfer',  [ResellerController::class, 'transfer'])->name('funds.transfer');
    Route::get('/reports',          [ResellerDashboardController::class, 'reports'])->name('reports');
    Route::get('/statement',        [ResellerDashboardController::class, 'statement'])->name('statement');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Users
    Route::resource('users', UserController::class);

    // Packages
    Route::get('/packages',           [PackageController::class, 'adminIndex'])->name('packages.index');
    Route::get('/packages/create',    [PackageController::class, 'adminCreate'])->name('packages.create');
    Route::post('/packages',          [PackageController::class, 'adminStore'])->name('packages.store');
    Route::get('/packages/{id}/edit', [PackageController::class, 'adminEdit'])->name('packages.edit');
    Route::put('/packages/{id}',      [PackageController::class, 'adminUpdate'])->name('packages.update');
    Route::delete('/packages/{id}',   [PackageController::class, 'adminDestroy'])->name('packages.destroy');

    // Folders
    Route::resource('folders', FolderController::class)->except(['show']);

    // Tickets
    Route::get('/tickets',                  [TicketController::class, 'adminIndex'])->name('tickets.index');
    Route::get('/tickets/{ticket}',         [TicketController::class, 'adminShow'])->name('tickets.show');
    Route::post('/tickets/{ticket}/reply',  [TicketController::class, 'adminReply'])->name('tickets.reply');
    Route::patch('/tickets/{ticket}/close', [TicketController::class, 'adminClose'])->name('tickets.close');

    // News
    Route::resource('news', NewsController::class);

    // Pages CMS
    Route::resource('pages', PageController::class);

    // Reports
    Route::get('/reports',             [ReportController::class, 'adminIndex'])->name('reports.index');
    Route::get('/reports/{report}',    [ReportController::class, 'adminShow'])->name('reports.show');
    Route::delete('/reports/{report}', [ReportController::class, 'adminDestroy'])->name('reports.destroy');

    // Currency
    Route::get('/currency',         [CurrencyController::class, 'index'])->name('currency.index');
    Route::post('/currency',        [CurrencyController::class, 'store'])->name('currency.store');
    Route::put('/currency/{id}',    [CurrencyController::class, 'update'])->name('currency.update');
    Route::delete('/currency/{id}', [CurrencyController::class, 'destroy'])->name('currency.destroy');

    // Funds admin
    Route::get('/funds',         [FundController::class, 'adminIndex'])->name('funds.index');
    Route::post('/funds/manual', [FundController::class, 'manual'])->name('funds.manual');
    Route::delete('/funds/{id}', [FundController::class, 'adminDestroy'])->name('funds.destroy');

    // Update / Versioning
    Route::get('/update',      [UpdatePageController::class, 'index'])->name('update.index');
    Route::post('/update/run', [UpdatePageController::class, 'run'])->name('update.run');

    // License
    Route::get('/license',  [LicenseController::class, 'index'])->name('license.index');
    Route::post('/license', [LicenseController::class, 'store'])->name('license.store');
});

require __DIR__.'/auth.php';