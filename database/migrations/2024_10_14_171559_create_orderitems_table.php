<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orderitems', function (Blueprint $table) {
            $table->id();                                              // Primary key (ID)
            $table->unsignedBigInteger('orderid_fk');                   // Foreign key to ordermaster
            $table->unsignedBigInteger('itemid_fk');                    // Foreign key to items
            $table->integer('qty');                                     // Quantity of the item in the order
            $table->decimal('price', 8, 2);                             // Price of the item
            $table->timestamps();                                       // Created_at and updated_at fields

            // Foreign key constraints
            $table->foreign('orderid_fk')->references('id')->on('ordermaster')->onDelete('cascade'); // Delete order items if the order is deleted
            $table->foreign('itemid_fk')->references('id')->on('items')->onDelete('cascade');        // Delete order items if the item is deleted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
