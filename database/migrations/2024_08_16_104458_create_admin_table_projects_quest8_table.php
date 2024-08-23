<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('admin_table_projects_quest8', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->unsignedBigInteger('who');
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('admin_table_projects8')->onDelete('cascade');
            $table->string('status')->default('todo'); // Добавлено поле для статуса задачи
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_table_projects_quest8');
    }
};