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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('Whatsapp_number')->nullable();
            // $table->string('phone_number');
            $table->integer('id_number');
            $table->string('address', 250);
            $table->date('birthDate')->nullable();
            $table->enum('gender', ['Male', 'Female']);
            $table->string('slug', 100)->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            //
        });
    }
};
