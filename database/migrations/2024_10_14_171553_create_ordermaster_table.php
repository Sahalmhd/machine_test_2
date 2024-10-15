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
        Schema::create('ordermaster', function (Blueprint $table) {
            $table->id();                                              // Primary key (ID)
            $table->string('customername');                             // Customer's name
            $table->text('address');                                    // Customer's address
            $table->string('phone');                                    // Customer's phone number
            $table->string('mobile');                                   // Customer's mobile number
            $table->date('orderdate');                                  // Date of the order
            $table->decimal('totalamount', 8, 2)->default(0.00);        // Total amount (default to 0)
            $table->string('orderstatus')->default('pending');          // Status of the order (default: pending)
            $table->timestamps();                                       // Created_at and updated_at fields
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordermaster');
    }
};
