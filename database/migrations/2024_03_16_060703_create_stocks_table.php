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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade')->onUpdate('cascade');
            $table->string('supplier_name', 48);
            $table->date('supplied_at');
            $table->bigInteger('invoice_Id');
            $table->integer('quantity');
            $table->date('expiry_date');
            $table->string('remarks', 255)->nullable();
            $table->enum('status', ['verified', 'unverified', 'deleted'])->default('unverified');
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->dateTime('verified_at')->nullable();
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};