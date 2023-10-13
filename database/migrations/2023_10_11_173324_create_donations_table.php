<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id(); // Auto-incremental primary key
            $table->unsignedBigInteger('user_id'); // The ID of the user who made the donation
            $table->string('title'); // Title of the donation request
            $table->text('description'); // Description of the donation request
            $table->decimal('amount', 10, 2); // The amount to be donated
            $table->decimal('target_amount', 10, 2); // The target donation amount
            $table->boolean('is_complete')->default(false); // Indicates if the donation request is complete
            $table->timestamps(); // Created at and updated at timestamps

            // Define foreign key constraint to link user_id with the 'users' table
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('donations');
    }
}
