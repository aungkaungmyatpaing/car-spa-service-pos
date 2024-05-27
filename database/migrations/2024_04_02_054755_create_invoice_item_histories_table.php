<?php

use App\Models\InvoiceHistory;
use App\Models\Service;
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
        Schema::create('invoice_item_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(InvoiceHistory::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('service_name');
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('total_price');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_item_histories');
    }
};
