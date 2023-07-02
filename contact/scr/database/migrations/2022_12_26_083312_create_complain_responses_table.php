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
        Schema::create('complain_responses', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->integer('user_id')->nullable();
            $table->integer('complain_id');
            $table->string('respond_direction');
            $table->string('email')->nullable();
            $table->text('respond_txt');
            $table->string('file1')->nullable();
            $table->string('file2')->nullable();
            $table->string('file3')->nullable();
            $table->string('file4')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complain_responses');
    }
};
