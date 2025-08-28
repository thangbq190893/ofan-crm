<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();$table->foreignId('customer_id')->constrained('customers');$table->foreignId('order_id')->nullable()->constrained('orders');$table->decimal('amount',14,2);$table->date('payment_date');$table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('receipts');
    }
};
