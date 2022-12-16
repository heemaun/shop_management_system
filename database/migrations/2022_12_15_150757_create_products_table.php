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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('name');
            $table->enum('status',['pending','active','deleted','banned','restricted'])->default('pending');
            $table->string('picture')->nullable();
            $table->float('initial_inventory')->default(0);
            $table->float('current_inventory')->default(0);
            $table->float('purchase_price')->default(0);
            $table->float('avg_purchase_price')->default(0);
            $table->float('selling_price')->default(0);
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
        Schema::dropIfExists('products');
    }
};
