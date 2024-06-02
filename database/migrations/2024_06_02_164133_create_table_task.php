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
            $table->timestamp('deploy_date')->nullable();
            $table->timestamp('submit_date')->nullable();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('description_id');
            $table->foreign('project_id')->references('id')->on('project');
            $table->foreign('description_id')->references('id')->on('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task');
    }
};
