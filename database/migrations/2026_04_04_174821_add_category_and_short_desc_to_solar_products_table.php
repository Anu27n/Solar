<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('solar_products', function (Blueprint $table) {
            $table->string('category')->nullable()->after('name');
            $table->text('short_description')->nullable()->after('category');
        });
    }

    public function down(): void
    {
        Schema::table('solar_products', function (Blueprint $table) {
            $table->dropColumn(['category', 'short_description']);
        });
    }
};
