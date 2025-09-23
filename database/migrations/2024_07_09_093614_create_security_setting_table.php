<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('security_setting', function (Blueprint $table) {
            $table->id();
            $table->string('max_failed_login_user')->nullable();
            $table->string('max_failed_login_admin')->nullable();
            $table->smallInteger('is_change_password_required')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('security_setting');
    }
};
