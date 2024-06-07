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
        Schema::create('revenue', function (Blueprint $table) {
            $table->id('revenue_id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('source_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('amount', 10, 2);
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->decimal('rest_amount', 10, 2)->computed('amount - paid_amount');
            $table->integer('total_installments');
            $table->string('installment_period');
            $table->timestamps();
            $table->softDeletes(); // Add this line

            $table->foreign('source_id')->references('source_id')->on('sources')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revenue');
    }
};
