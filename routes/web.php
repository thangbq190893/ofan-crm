<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth','identify.branch'])->group(function () {
    Route::resource('branches', App\Http\Controllers\Web\BranchesController::class);
    Route::resource('warehouses', App\Http\Controllers\Web\WarehousesController::class);
    Route::resource('inventory', App\Http\Controllers\Web\InventoryController::class);
    Route::resource('inventory_movements', App\Http\Controllers\Web\InventoryMovementsController::class);
    Route::resource('permissions', App\Http\Controllers\Web\PermissionsController::class);
    Route::resource('roles', App\Http\Controllers\Web\RolesController::class);
    Route::resource('role_permissions', App\Http\Controllers\Web\RolePermissionsController::class);
    Route::resource('user_roles', App\Http\Controllers\Web\UserRolesController::class);
    Route::resource('users', App\Http\Controllers\Web\UsersController::class);
    Route::resource('notifications', App\Http\Controllers\Web\NotificationsController::class);
    Route::resource('logs', App\Http\Controllers\Web\LogsController::class);
    Route::resource('expenses', App\Http\Controllers\Web\ExpensesController::class);
    Route::resource('product_categories', App\Http\Controllers\Web\ProductCategoriesController::class);
    Route::resource('products', App\Http\Controllers\Web\ProductsController::class);
    Route::resource('product_images', App\Http\Controllers\Web\ProductImagesController::class);
    Route::resource('customers', App\Http\Controllers\Web\CustomersController::class);
    Route::resource('customer_devices', App\Http\Controllers\Web\CustomerDevicesController::class);
    Route::resource('warranty_tickets', App\Http\Controllers\Web\WarrantyTicketsController::class);
    Route::resource('maintenance_jobs', App\Http\Controllers\Web\MaintenanceJobsController::class);
    Route::resource('kpi_definitions', App\Http\Controllers\Web\KpiDefinitionsController::class);
    Route::resource('kpi_results', App\Http\Controllers\Web\KpiResultsController::class);
    Route::resource('orders', App\Http\Controllers\Web\OrdersController::class);
    Route::resource('order_items', App\Http\Controllers\Web\OrderItemsController::class);
    Route::resource('payments', App\Http\Controllers\Web\PaymentsController::class);
    Route::resource('payment_methods', App\Http\Controllers\Web\PaymentMethodsController::class);
    Route::resource('invoices', App\Http\Controllers\Web\InvoicesController::class);
    Route::resource('returns', App\Http\Controllers\Web\ReturnsController::class);
    Route::resource('return_items', App\Http\Controllers\Web\ReturnItemsController::class);
    Route::resource('receipts', App\Http\Controllers\Web\ReceiptsController::class);
});

Route::get('/', function(){ return view('index'); })->middleware(['auth','identify.branch']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
