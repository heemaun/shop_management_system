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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('user_name')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('status',['active','pending','deleted','banned','restricted'])->default('pending');
            $table->enum('gender',['male','female','other']);
            $table->enum('role',['super_admin','admin','manager','seller','customer'])->default('customer');
            $table->integer('salary')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('picture')->nullable();
            $table->text('address')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
