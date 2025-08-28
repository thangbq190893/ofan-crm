<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->id(); $table->foreignId('inventory_id')->constrained('inventory'); $table->string('type'); $table->integer('qty'); $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('inventory_movements');
    }
};
