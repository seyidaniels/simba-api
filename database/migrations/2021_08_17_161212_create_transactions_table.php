<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender');
            $table->unsignedBigInteger('receiver');
            $table->enum('currency', ['USD', 'NGN', 'GBP']);
            // Keeping Reference code length at 25 to decrease probability of generating same reference code
            $table->string('reference_code', 25)->unique();
            $table->decimal('amount_in_transaction_currency');
            $table->decimal('rate_at_transaction')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('sender')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
