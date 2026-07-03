<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paolorox_customalert_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable()->index();
            $table->string('session_id', 100)->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('config_hash', 32)->index();
            $table->string('status', 20)->default('shown'); // shown, dismissed
            $table->string('button_clicked', 100)->nullable();
            $table->timestamps();

            $table->index(['config_hash', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paolorox_customalert_logs');
    }
};
