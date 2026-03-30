<?php

use App\Models\Invoice;
use App\Models\Reservation;
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
        Schema::table('payments', function (Blueprint $table) {
            $table->enum('payment_type', ['reservation_fee', 'security_deposit', 'rent'])
                ->default('reservation_fee')
                ->after('reservation_id');
            $table->foreignIdFor(Invoice::class)->nullable()->after('payment_type')->constrained();
            $table->foreignIdFor(Reservation::class)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['invoice_id']);

            $table->dropColumn(['payment_type', 'invoice_id']);

            $table->foreignIdFor(Reservation::class)->nullable(false)->change();
        });
    }
};
