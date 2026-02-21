<?php

use App\Models\Host;
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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Host::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('address');
            $table->string('description');
            $table->string('price');
            $table->enum('status', ['available', 'unavailable'])->default('available');
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->enum('tenant_type', ['student', 'regular'])->default('student');
            $table->integer('slot');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
