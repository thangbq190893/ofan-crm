<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id(); $table->foreignId('customer_id')->constrained('customers'); $table->foreignId('order_id')->constrained('orders'); $table->decimal('amount', 15, 2)->nullable(); $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('receipts');
    }
};
