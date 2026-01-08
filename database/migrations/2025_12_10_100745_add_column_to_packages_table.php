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
        Schema::table('packages', function (Blueprint $table) {
            $table->bigInteger('company_id')->nullable()->after('id');
            $table->text('package_details')->nullable()->after('company_id');
            $table->longText('category_id')->nullable()->after('package_details');
            $table->text('test_id')->nullable()->after('category_id');
            $table->string('report_id')->nullable()->after('test_id');
            $table->string('other_category')->nullable()->after('report_id');
            $table->string('other_test')->nullable()->after('other_category');
            $table->string('name')->after('other_test');
            $table->decimal('price', 8, 2)->after('name');
            $table->decimal('discount_price', 8, 2)->nullable()->after('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            //
        });
    }
};
