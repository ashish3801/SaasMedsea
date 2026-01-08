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
        Schema::create('qr_registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('package_id')->nullable();
            $table->string('indos_no');
            $table->string('register_no')->nullable();
            $table->string('passport_no');
            $table->string('cdc_no');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->date('appointment_date')->nullable();
            $table->date('dob')->nullable();
            $table->string('pob')->nullable();
            $table->unsignedBigInteger('rank')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->unsignedBigInteger('nationality')->nullable();
            $table->unsignedBigInteger('clinic')->nullable();
            $table->unsignedBigInteger('doctor')->nullable();
            $table->string('company_name')->nullable();
            $table->string('address')->nullable();
            $table->string('vessel_name')->nullable();
            $table->string('vessel_type')->nullable();
            $table->string('route')->nullable();
            $table->string('contact_number');
            $table->string('email')->nullable();
            $table->unsignedBigInteger('referred_by')->nullable();
            $table->longText('signature')->nullable();
            $table->string('profile')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qr_registrations');
    }
};
