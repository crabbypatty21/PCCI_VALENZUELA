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
        if (!Schema::hasTable('applicants')) {
            Schema::create('applicants', function (Blueprint $table) {
                $table->id();
                $table->string('status')->default('pending');
                $table->string('membership_type')->nullable();
                $table->string('business_address')->nullable();
                $table->string('contact_number')->nullable();
                $table->timestamps();
            });
        } else {
            Schema::table('applicants', function (Blueprint $table) {
                if (!Schema::hasColumn('applicants', 'business_address')) {
                    $table->string('business_address')->nullable();
                }
                if (!Schema::hasColumn('applicants', 'contact_number')) {
                    $table->string('contact_number')->nullable();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};