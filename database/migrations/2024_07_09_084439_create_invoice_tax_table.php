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
        Schema::create('invoice_tax', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('gst_number')->nullable();
            $table->string('pan_number')->nullable();
            $table->string('registered_address')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('sgst')->nullable();
            $table->string('cgst')->nullable();
            $table->string('igst')->nullable();
            $table->string('invoice_prefix')->nullable();
            $table->string('invoice_number')->nullable();
            $table->longText('term_and_condition')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_tax');
    }
};
