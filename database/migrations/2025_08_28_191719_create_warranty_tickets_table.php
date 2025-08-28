<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('warranty_tickets', function (Blueprint $table) {
            $table->id(); $table->foreignId('customer_device_id')->constrained('customer_devices'); $table->foreignId('technician_id')->constrained('users'); $table->string('status'); $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('warranty_tickets');
    }
};
