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
        Schema::table('invoice_tax', function (Blueprint $table) {
            $table->string('invoice_logo')->nullable()->after('invoice_number');
            $table->string('invoice_email')->nullable()->after('invoice_logo');
            $table->string('invoice_mobile')->nullable()->after('invoice_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoice_tax', function (Blueprint $table) {
            $table->dropColumn(['invoice_logo', 'invoice_email', 'invoice_mobile']);
        });
    }
};
