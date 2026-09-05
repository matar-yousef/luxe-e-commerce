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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');           // اسم المنتج
            $table->text('description');     // وصف المنتج
            $table->decimal('price', 8, 2);  // السعر (مثل 99.99)
            $table->string('image')->nullable(); // مسار الصورة
            $table->integer('stock')->default(0); // الكمية المتوفرة
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
