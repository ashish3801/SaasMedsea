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
        Schema::table('tests', function (Blueprint $table) {
             
            $table->string('category_id')->nullable()->after('company_id');
            $table->text('text_value')->nullable()->after('discount_price');
            $table->enum('field_type', ['text', 'dropdown'])->default('text')->after('text_value');
            $table->string('dropdown_values')->nullable()->after('field_type');
            $table->string('slug')->nullable()->after('dropdown_values');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tests', function (Blueprint $table) {
            Schema::dropIfExists('tests');
        });
    }
};
