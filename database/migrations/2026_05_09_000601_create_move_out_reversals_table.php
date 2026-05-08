<?php

use App\Models\MoveOutNotice;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('move_out_reversals', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(MoveOutNotice::class)
                ->constrained('move_out_notices')
                ->cascadeOnDelete();

            $table->text('reason');

            $table->enum('status', ['pending', 'approved', 'rejected'])
                ->default('pending');

            $table->foreignId('reviewed_by_host_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->text('host_notes')->nullable();

            $table->timestamp('reviewed_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('move_out_reversals');
    }
};
