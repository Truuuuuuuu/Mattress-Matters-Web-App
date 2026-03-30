<?php

use App\Models\Rental;
use App\Models\Tenant;
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
        Schema::create('invoices', function (Blueprint $table) {
           /* $table->id();
            $table->foreignIdFor(Rental::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Tenant::class)->constrained()->cascadeOnDelete();
            $table->string('period_month', 7);                    // "2026-04"
            $table->decimal('amount_due', 10, 2);
            $table->decimal('rent_cost_snapshot', 10, 2);
            $table->decimal('electricity_cost_snapshot', 10, 2)->nullable();
            $table->decimal('water_supply_cost_snapshot', 10, 2)->nullable();
            $table->date('due_date');
            $table->string('xendit_id')->nullable();
            $table->string('xendit_invoice_url')->nullable();
            $table->enum('status', ['unpaid', 'paid', 'overdue'])->default('unpaid');
            $table->timestamps();

            $table->unique(['rental_id', 'period_month']);*/
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
