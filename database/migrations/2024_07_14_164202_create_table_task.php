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
        Schema::create('task', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->date('submit_date')->nullable();
            $table->longText('description')->nullable();
            $table->softDeletes();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('users');
            $table->unsignedBigInteger('board_id');
            $table->foreign('board_id')->references('id')->on('board');
          //  $table->date('deploy_date')->nullable();
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('project');
           // $table->enum('status',['pending','done','late','end'])->nullable()->default('pending');
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('task', function (Blueprint $table) {
            $table->dropSoftDeletes(); 
        });
    }
};
