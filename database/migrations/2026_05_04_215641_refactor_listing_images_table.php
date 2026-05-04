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
        Schema::table('listing_images', function (Blueprint $table) {
            $table->dropColumn('image_path'); // remove old Laravel storage column

            $table->string('cloudinary_public_id')->after('listing_id');
            $table->tinyInteger('sort_order')->default(0)->after('cloudinary_public_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listing_images', function (Blueprint $table) {
            $table->string('image_path')->nullable();
            $table->dropColumn(['cloudinary_public_id', 'sort_order']);
        });
    }
};
