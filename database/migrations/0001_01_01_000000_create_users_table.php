<?php

use App\Helpers\V1\Roles;
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
        Schema::create('users', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('company_id')->constrained()->cascadeOnDelete();
            $table->string('creator_id')->nullable();
            // $table->foreignUlid('creator_id')->nullable()->constrained("users")->cascadeOnDelete();
            $table->foreignUlid('state_id')->constrained()->cascadeOnDelete();
            $table->string('last_updated_id')->nullable();
            // $table->foreignUlid('last_updated_id')->nullable()->constrained("users")->cascadeOnDelete();
            $table->string('area_id')->nullable();
            $table->foreignUlid('lga_id')->nullable()->constrained("lgas")->cascadeOnDelete();
            $table->string('office_id')->nullable();

            $table->string('firstname');
            $table->string('lastname');
            $table->string('othername')->nullable();
            $table->string('image')->nullable();
            $table->string('nin')->nullable();
            $table->enum('role', Roles::USER_ROLES)->nullable()->default(Roles::GENERAL_USER)->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('status')->nullable()->default('active');
            $table->string('registeration_type')->nullable()->default('registeration');
            $table->string('state_verification_no')->nullable();
            $table->date('date_of_birth')->nullable();
    
            $table->boolean('is_email_verified')->nullable()->default(false);
            $table->timestamp('email_verified_at')->nullable()->default(now());
            $table->timestamp('date_deactivated')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
