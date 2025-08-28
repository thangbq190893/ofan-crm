<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();$table->foreignId('warehouse_id')->constrained('warehouses');$table->foreignId('product_id')->constrained('products');$table->integer('quantity')->default(0);$table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('inventory');
    }
};
