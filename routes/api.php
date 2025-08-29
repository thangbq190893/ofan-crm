<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('branches', App\Http\Controllers\Api\BranchesController::class);
    Route::apiResource('warehouses', App\Http\Controllers\Api\WarehousesController::class);
    Route::apiResource('inventory', App\Http\Controllers\Api\InventoryController::class);
    Route::apiResource('inventory_movements', App\Http\Controllers\Api\InventoryMovementsController::class);
    Route::apiResource('permissions', App\Http\Controllers\Api\PermissionsController::class);
    Route::apiResource('roles', App\Http\Controllers\Api\RolesController::class);
    Route::apiResource('role_permissions', App\Http\Controllers\Api\RolePermissionsController::class);
    Route::apiResource('user_roles', App\Http\Controllers\Api\UserRolesController::class);
    Route::apiResource('users', App\Http\Controllers\Api\UsersController::class);
    Route::apiResource('notifications', App\Http\Controllers\Api\NotificationsController::class);
    Route::apiResource('logs', App\Http\Controllers\Api\LogsController::class);
    Route::apiResource('expenses', App\Http\Controllers\Api\ExpensesController::class);
    Route::apiResource('product_categories', App\Http\Controllers\Api\ProductCategoriesController::class);
    Route::apiResource('products', App\Http\Controllers\Api\ProductsController::class);
    Route::apiResource('product_images', App\Http\Controllers\Api\ProductImagesController::class);
    Route::apiResource('customers', App\Http\Controllers\Api\CustomersController::class);
    Route::apiResource('customer_devices', App\Http\Controllers\Api\CustomerDevicesController::class);
    Route::apiResource('warranty_tickets', App\Http\Controllers\Api\WarrantyTicketsController::class);
    Route::apiResource('maintenance_jobs', App\Http\Controllers\Api\MaintenanceJobsController::class);
    Route::apiResource('kpi_definitions', App\Http\Controllers\Api\KpiDefinitionsController::class);
    Route::apiResource('kpi_results', App\Http\Controllers\Api\KpiResultsController::class);
    Route::apiResource('orders', App\Http\Controllers\Api\OrdersController::class);
    Route::apiResource('order_items', App\Http\Controllers\Api\OrderItemsController::class);
    Route::apiResource('payments', App\Http\Controllers\Api\PaymentsController::class);
    Route::apiResource('payment_methods', App\Http\Controllers\Api\PaymentMethodsController::class);
    Route::apiResource('invoices', App\Http\Controllers\Api\InvoicesController::class);
    Route::apiResource('returns', App\Http\Controllers\Api\ReturnsController::class);
    Route::apiResource('return_items', App\Http\Controllers\Api\ReturnItemsController::class);
    Route::apiResource('receipts', App\Http\Controllers\Api\ReceiptsController::class);
});
