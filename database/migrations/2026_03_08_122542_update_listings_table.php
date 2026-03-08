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

        Schema::table('listings', function (Blueprint $table) {
            $table->renameColumn('price', 'rent_cost')->change();
        });

        Schema::table('listings', function (Blueprint $table) {
            $table->decimal('rent_cost', 7, 2)->change();
        });

        Schema::table('listings', function (Blueprint $table) {
            $table->decimal('electricity_cost', 7, 2)
                ->after('rent_cost')
                ->nullable();
            $table->decimal('water_supply_cost', 7, 2)
                ->after('electricity_cost')
                ->nullable();

        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            //
        });
    }
};
