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
         Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('clinic_id')->nullable();
            $table->string('emp_id')->nullable();
            $table->string('emp_name')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('email')->nullable();
            $table->string('degree')->nullable();
            $table->string('reg_no')->nullable();
            $table->string('dgs_approval_number')->nullable();
            $table->string('certificate_issued_by')->nullable();
            $table->date('certificate_issue_date')->nullable();
            $table->string('sign_upload')->nullable();
            $table->string('stamp_upload')->nullable();
            $table->tinyInteger('is_active')->default(1)->comment('1=active,0=is_inactive');
            $table->integer('role_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
