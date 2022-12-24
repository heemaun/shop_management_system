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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('from_account')->nullable()->references('id')->on('accounts')->onDelete('cascade');
            $table->foreignId('to_account')->nullable()->references('id')->on('accounts')->onDelete('cascade');
            $table->foreignId('from_user')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('to_user')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->enum('status',['active','pending','deleted','banned','restricted'])->default('pending');
            $table->enum('from_select',['user','account']);
            $table->enum('to_select',['user','account']);
            $table->float('amount')->default(0);
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
        Schema::dropIfExists('transactions');
    }
};
