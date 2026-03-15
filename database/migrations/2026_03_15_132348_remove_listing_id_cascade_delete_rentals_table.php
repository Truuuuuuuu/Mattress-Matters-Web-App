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
        Schema::table('rentals', function (Blueprint $table) {
            $table->dropForeign(['listing_id']);

            $table->foreign('listing_id')
                ->references('id')
                ->on('listings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rentals', function (Blueprint $table) {
            // Revert back to cascade if you roll back
            $table->dropForeign(['listing_id']);
            $table->dropForeign(['user_id']);

            $table->foreign('listing_id')
                ->references('id')
                ->on('listings')
                ->cascadeOnDelete();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }
};
