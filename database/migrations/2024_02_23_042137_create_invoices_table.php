<?php

use App\Models\User;
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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('invoice_number');
            $table->unsignedInteger('total_price')->default(0);
            $table->unsignedInteger('discount')->default(0);
            $table->boolean('is_fixed')->default(false);
            $table->unsignedInteger('tax')->default(0);
            $table->unsignedInteger('grand_total')->default(0);
            $table->unsignedInteger('paid')->default(0);
            $table->unsignedInteger('change')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
