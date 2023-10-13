<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationUserTable extends Migration
{
    public function up()
    {
        Schema::create('donation_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('donation_id');
            $table->decimal('amount', 10, 2); // Example column for the donation amount
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('donation_id')->references('id')->on('donations')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('donation_user');
    }
};
