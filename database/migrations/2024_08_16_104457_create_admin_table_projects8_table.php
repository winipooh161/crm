<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('admin_table_projects8', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->unsignedBigInteger('who');
            $table->string('name');
            $table->string('organization')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->string('admin_table_projects_quest')->nullable(); // Ссылка на связанную таблицу задач
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_table_projects8');
    }
};