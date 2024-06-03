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
        Schema::create('sertifikats', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('title');
            $table->string('recipient_name');
            $table->bigInteger('instansi_id');
            $table->foreign('instansi_id')->references('id')->on('instansis')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->date('validated_at')->nullable();
            $table->string('validated_by')->nullable();
            $table->string('certificate_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikats');
    }
};
