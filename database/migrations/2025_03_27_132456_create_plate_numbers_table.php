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
        Schema::create('plate_numbers', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('company_id')->constrained()->cascadeOnDelete();
            $table->foreignUlid('creator_id')->constrained("users")->cascadeOnDelete();
            $table->foreignUlid('last_updated_id')->nullable()->constrained("users")->cascadeOnDelete();
            $table->foreignUlid('deactivated_by_id')->nullable()->constrained("users")->cascadeOnDelete();
            $table->foreignUlid('state_id')->constrained("states")->cascadeOnDelete();

            $table->string('number');
            $table->string('number_status')->nullable()->default('Paid');
            $table->string('status')->nullable()->default('Sold');
            $table->string('agent_id')->nullable();
            $table->string('owner_id')->nullable();
            $table->string('request_id')->nullable();
            $table->string('stock_id')->nullable();
            $table->string('type')->nullable()->default('Pivate');
            $table->string('sub_type')->nullable()->default('Direct');

            $table->timestamp('date_deactivated')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plate_numbers');
    }
};
