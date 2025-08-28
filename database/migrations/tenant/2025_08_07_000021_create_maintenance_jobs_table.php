<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('maintenance_jobs', function (Blueprint $table) {
            $table->id();$table->foreignId('customer_device_id')->constrained('customer_devices');$table->foreignId('technician_id')->constrained('users');$table->enum('status',['SCHEDULED','DONE']);$table->dateTime('schedule_at');$table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('maintenance_jobs');
    }
};
