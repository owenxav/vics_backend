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
        Schema::create('companies', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('state_id')->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->string('licence')->nullable();
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('address')->nullable();
            $table->json('color')->nullable();
            $table->json('logo')->nullable();
            $table->json('logo_svg')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
