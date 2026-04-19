<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('tagline')->nullable();
            $table->text('address_office');
            $table->text('address_factory')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode')->nullable();
            $table->string('gstin')->nullable();
            $table->json('phones')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();

            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('bank_ac_no')->nullable();
            $table->string('bank_ifsc')->nullable();
            $table->string('bank_pin')->nullable();

            $table->string('signatory_name')->nullable();
            $table->string('signatory_title')->nullable();
            $table->string('signatory_phone')->nullable();

            $table->string('ref_prefix');
            $table->unsignedBigInteger('next_quotation_seq')->default(1);
            $table->string('ref_year_mode')->default('calendar'); // calendar | fiscal

            $table->decimal('default_gst_percent', 5, 2)->default(18);
            $table->unsignedSmallInteger('default_validity_days')->default(60);
            $table->text('default_payment_terms')->nullable();
            $table->text('default_delivery_terms')->nullable();
            $table->text('default_warranty_terms')->nullable();
            $table->string('default_freight')->nullable();
            $table->string('default_jurisdiction')->default('Kanpur');
            $table->text('default_cover_letter')->nullable();

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_profiles');
    }
};
