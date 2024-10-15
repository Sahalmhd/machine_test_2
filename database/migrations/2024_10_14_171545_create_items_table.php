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
        Schema::create('items', function (Blueprint $table) {
            $table->id();                                   // Primary key (ID)
            $table->string('itemname');                     // Name of the item
            $table->integer('qty');                         // Stock quantity
            $table->decimal('price', 8, 2);                 // Price of the item (decimal)
            $table->boolean('status')->default(true);       // Status (true for active, false for inactive)
            $table->timestamps();                           // Created_at and updated_at fields
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
