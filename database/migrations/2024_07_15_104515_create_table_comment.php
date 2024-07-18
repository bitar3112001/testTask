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
        Schema::create('comment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->foreign('task_id')->references('id')->on('task');
          //  $table->unsignedBigInteger('employee_id');
           // $table->foreign('employee_id')->references('id')->on('users');
            $table->longText('comment');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comment', function (Blueprint $table) {
            $table->dropSoftDeletes(); 
        });
    }
};
