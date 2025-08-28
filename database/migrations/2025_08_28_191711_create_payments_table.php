<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); $table->foreignId('order_id')->constrained('orders'); $table->foreignId('payment_method_id')->constrained('payment_methods'); $table->decimal('amount', 15, 2); $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('payments');
    }
};
