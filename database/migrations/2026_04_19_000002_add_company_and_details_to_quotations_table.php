<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quotations', function (Blueprint $table) {
            $table->foreignId('company_profile_id')->nullable()->after('customer_id')
                ->constrained('company_profiles')->nullOnDelete();

            $table->string('reference_number')->nullable()->unique()->after('company_profile_id');
            $table->string('location')->nullable()->after('reference_number');
            $table->string('subject', 500)->nullable()->after('location');
            $table->string('kind_attn')->nullable()->after('subject');

            $table->decimal('subtotal', 14, 2)->default(0)->after('kind_attn');
            $table->decimal('gst_percent', 5, 2)->default(18)->after('subtotal');
            $table->decimal('gst_amount', 14, 2)->default(0)->after('gst_percent');
            $table->decimal('grand_total', 14, 2)->default(0)->after('gst_amount');

            $table->unsignedSmallInteger('validity_days')->default(60)->after('grand_total');
            $table->text('payment_terms')->nullable()->after('validity_days');
            $table->text('delivery_terms')->nullable()->after('payment_terms');
            $table->text('warranty_terms')->nullable()->after('delivery_terms');
            $table->string('freight')->nullable()->after('warranty_terms');
            $table->string('jurisdiction')->nullable()->after('freight');
            $table->text('notes')->nullable()->after('jurisdiction');
            $table->text('cover_letter')->nullable()->after('notes');
        });
    }

    public function down(): void
    {
        Schema::table('quotations', function (Blueprint $table) {
            $table->dropConstrainedForeignId('company_profile_id');
            $table->dropColumn([
                'reference_number', 'location', 'subject', 'kind_attn',
                'subtotal', 'gst_percent', 'gst_amount', 'grand_total',
                'validity_days', 'payment_terms', 'delivery_terms', 'warranty_terms',
                'freight', 'jurisdiction', 'notes', 'cover_letter',
            ]);
        });
    }
};
