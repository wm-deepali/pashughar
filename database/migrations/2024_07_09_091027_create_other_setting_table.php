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
        Schema::create('other_setting', function (Blueprint $table) {
            $table->id();
            $table->string('tds')->nullable();
            $table->string('admin_charges')->nullable();
            $table->string('other_charges')->nullable();
            $table->string('user_expiry')->nullable();
            $table->string('welcome_bonus')->nullable();
            $table->string('wallet_limit')->nullable();
            $table->smallInteger('is_referral_enable')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_setting');
    }
};
