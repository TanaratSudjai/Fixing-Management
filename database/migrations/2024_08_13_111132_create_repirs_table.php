<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('repir', function (Blueprint $table) {
            $table->id('repair_id');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('repair_detail');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->bigInteger('unit_amount')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('product_id')->references('product_id')->on('product')->onDelete('set null');
            $table->foreign('status_id')->references('status_id')->on('status')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repirs');
    }
};
