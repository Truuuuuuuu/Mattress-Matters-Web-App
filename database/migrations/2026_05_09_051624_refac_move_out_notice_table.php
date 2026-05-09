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
        Schema::table('move_out_notices', function (Blueprint $table) {
            $table->enum('initiated_by', ['tenant', 'host'])->default('tenant')->after('rental_id');
            $table->date('vacate_by_date')->nullable()->after('move_out_date');
            $table->timestamp('notice_sent_at')->nullable()->after('reason');
            $table->enum('tenant_response', ['accepted', 'disputed'])->nullable()->after('notice_sent_at');
            $table->timestamp('tenant_responded_at')->nullable()->after('tenant_response');
            $table->enum('status', ['pending', 'acknowledged', 'disputed', 'completed', 'cancelled'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('move_out_notices', function (Blueprint $table) {
            //
        });
    }
};
