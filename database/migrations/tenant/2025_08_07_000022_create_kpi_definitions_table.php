<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('kpi_definitions', function (Blueprint $table) {
            $table->id();$table->string('name');$table->text('formula');$table->decimal('target_value',14,2);$table->enum('period_type',['MONTH','QUARTER','YEAR']);$table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('kpi_definitions');
    }
};
