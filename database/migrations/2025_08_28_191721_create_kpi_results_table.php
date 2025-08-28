<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('kpi_results', function (Blueprint $table) {
            $table->id(); $table->foreignId('kpi_definition_id')->constrained('kpi_definitions'); $table->foreignId('user_id')->constrained('users'); $table->date('period_start'); $table->boolean('achieved'); $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('kpi_results');
    }
};
