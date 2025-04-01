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
        Schema::create('plate_number_orders', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('company_id')->constrained()->cascadeOnDelete();
            $table->foreignUlid('creator_id')->constrained("users")->cascadeOnDelete();
            $table->foreignUlid('last_updated_id')->nullable()->constrained("users")->cascadeOnDelete();
            $table->foreignUlid('deactivated_by_id')->nullable()->constrained("users")->cascadeOnDelete();
            $table->foreignUlid('state_id')->constrained("states")->cascadeOnDelete();
            $table->string('invoice_id')->nullable();
            $table->string('vehicle_id')->nullable();

            $table->enum('type', ['Request', 'Sale'])->nullable()->default('Request');
            $table->string('status')->nullable()->default('Sold');
            $table->string('assignment_status')->nullable();
            $table->string('fancy_plate')->nullable();
            $table->integer('prefix')->nullable()->default(0);
            $table->integer('recommended_number')->nullable()->default(0);
            $table->integer('total_number_requested')->nullable()->default(0);
            $table->string('tracking_id')->nullable();
            $table->string('workflow_approval_status')->nullable();
            $table->string('plate_number_type')->nullable()->default('Pivate');
            $table->string('plate_number_sub_type')->nullable()->default('Direct');
            $table->string('workflow_id')->nullable();
            $table->string('reference_number')->nullable();

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
        Schema::dropIfExists('plate_number_orders');
    }
};
