<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserImg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_img', function(Blueprint $table){
            $table->id();
            $table->string('location_pincode');
            $table->string('phone_number');
            $table->string('media_link');
            $table->enum('approval',['under_process','approved','rejected'])->default('under_process');
            $table->dateTime('date')->nullable();
            $table->timestamp('updated_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('is_checked');
            $table->integer('is_downloaded');
            $table->integer('is_deleted')->nullable();
            $table->dateTime('rejected_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_img');
    }
}
