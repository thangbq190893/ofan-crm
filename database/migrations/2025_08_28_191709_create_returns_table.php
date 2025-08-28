<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('returns', function (Blueprint $table) {
            $table->id(); $table->foreignId('order_id')->constrained('orders'); $table->foreignId('customer_id')->constrained('customers'); $table->string('status'); $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('returns');
    }
};
