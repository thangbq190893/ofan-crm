<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('return_items', function (Blueprint $table) {
            $table->id();$table->foreignId('return_id')->constrained('returns')->onDelete('cascade');$table->foreignId('product_id')->constrained('products');$table->integer('qty');$table->string('reason');$table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('return_items');
    }
};
