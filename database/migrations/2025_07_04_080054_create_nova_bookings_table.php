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
        Schema::create('nova_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('nova_customers')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('nova_services')->onDelete('cascade');
            $table->foreignId('staff_id')->nullable()->constrained('nova_staffs')->onDelete('set null');
            $table->dateTime('booking_time');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nova_bookings');
    }
};
