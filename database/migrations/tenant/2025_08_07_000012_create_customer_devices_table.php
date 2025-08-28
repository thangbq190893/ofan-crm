<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('customer_devices', function (Blueprint $table) {
            $table->id();$table->foreignId('customer_id')->constrained('customers');$table->foreignId('product_id')->constrained('products');$table->string('serial_number')->unique();$table->date('install_date');$table->date('next_filter_change_date')->nullable();$table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('customer_devices');
    }
};
