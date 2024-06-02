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
        Schema::create('taskassign', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('status',['pending','done','late']);
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('description_id');
            $table->foreign('employee_id')->references('id')->on('users');
            $table->foreign('task_id')->references('id')->on('task');
            $table->foreign('description_id')->references('id')->on('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taskassign');
    }
};
