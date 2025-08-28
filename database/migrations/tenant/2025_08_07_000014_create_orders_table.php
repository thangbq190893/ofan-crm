<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();$table->string('order_code')->unique();$table->foreignId('customer_id')->constrained('customers');$table->foreignId('branch_id')->constrained('branches');$table->decimal('total_amount',14,2);$table->enum('status',['NEW','DELIVERY','DONE','CANCEL']);$table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('orders');
    }
};
