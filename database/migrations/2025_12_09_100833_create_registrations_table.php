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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('seafarer_id')->unsigned();
            $table->bigInteger('company_id')->unsigned();
            $table->string('indos_no', 100)->nullable();
            $table->string('passport_no', 100)->nullable();
            $table->string('cdc_no', 15)->nullable();
            $table->string('aadhaar_no', 100)->nullable();
            $table->dateTime('date')->nullable();
            $table->bigInteger('rank_id')->unsigned();
            $table->bigInteger('nationality_id')->unsigned();
            $table->bigInteger('clinic_id')->unsigned()->nullable();

            $table->string('employee_id', 100)->nullable();
            $table->integer('package_id')->nullable();

            $table->string('company_name', 255)->nullable();
            $table->string('address', 255)->nullable();

            $table->text('profile')->nullable();
            $table->text('signature')->nullable();

            $table->text('docs_1')->nullable();
            $table->text('docs_2')->nullable();
            $table->text('docs_3')->nullable();

            $table->string('vessel_name', 255)->nullable();
            $table->string('vessel_type', 255)->nullable();
            $table->string('route', 255)->nullable();
            $table->string('referred_by', 255)->nullable();

            $table->integer('is_qr_register')->default(0);

            $table->tinyInteger('created_by')->nullable();
            $table->tinyInteger('is_active')->default(1); // 1 = active, 0 = inactive
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
