<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('status');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE tasks ADD FULLTEXT fulltext_index_name (name, email)');
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}