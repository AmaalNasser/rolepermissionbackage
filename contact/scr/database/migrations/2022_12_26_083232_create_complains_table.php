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
        Schema::create('complains', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->integer('project_id');
            $table->string('email')->nullable();
            $table->integer('complain_category_id');
            $table->text('details');
            $table->string('file1')->nullable();
            $table->string('file2')->nullable();
            $table->string('file3')->nullable();
            $table->string('file4')->nullable();
            $table->string('status')->default('Open');
            $table->integer('updated_by')->nullable();
            $table->integer('created_by')->nullable();;
            $table->integer('deleted_by')->nullable();
            $table->string('closed_by')->nullable();
            $table->string('priority')->nullable();
            $table->string('complain_subject');
            $table->timestamps();
            $table->timestamp('closed_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complains');
    }
};
