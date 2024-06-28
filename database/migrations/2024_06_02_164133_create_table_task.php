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
            $table->date('deploy_date')->nullable();
            $table->date('submit_date')->nullable();
            $table->unsignedBigInteger('project_id');
            $table->longText('description');
            $table->foreign('project_id')->references('id')->on('project');
            $table->enum('status',['pending','done','late','end'])->nullable()->default('pending');
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
