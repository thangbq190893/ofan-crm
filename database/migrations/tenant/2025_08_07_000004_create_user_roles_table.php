<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();$table->foreignId('role_id')->constrained();$table->primary(['user_id','role_id']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('user_roles');
    }
};
