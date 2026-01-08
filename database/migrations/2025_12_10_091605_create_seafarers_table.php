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
         Schema::create('seafarers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('f_name');
            $table->string('m_name')->nullable();
            $table->string('l_name');
            $table->string('phone_no')->nullable();
            $table->string('email')->nullable();
            $table->string('dob')->comment('Date of Birth')->nullable();
            $table->string('pob')->comment('Place of Birth')->nullable();
            $table->tinyInteger('gender');
            $table->tinyInteger('created_by')->nullable();
            $table->tinyInteger('is_active')->default(1)->comment('1=active, 0=inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seafarers');
    }
};
