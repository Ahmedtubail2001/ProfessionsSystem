<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id(); //biginteger unsigned Auto_Increment Primary
            // id == id2
            // $table->bigInteger('id2')->unsigned()->autoIncrement()->primary();
            // ==
            // $table->unsignedBigInteger('id');
            $table->string('name');
            $table->text('description');
            $table->dateTime('time_first')->nullable();
            $table->string('slug', 100);
            $table->text('notes')->nullable();
            $table->dateTime('time_function')->nullable();
            $table->text('additional_file')->nullable();
            $table->integer('value');
            $table->float('funds')->default(0.2);
            $table->integer('city_id');
            $table->string('description_location')->nullable();
            $table->boolean('accept')->default(true);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('worker_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            // $table->foreign('worker_id')->references('id')->on('workers')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
