<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('users')->onDelete('cascade');
            $table->string('supplier_brand'); 
            $table->string('sku')->unique();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('category_id')->constrained('categories');
            
            // FITUR KHUSUS HANDPHONE
            $table->enum('condition', ['Baru', 'Bekas'])->default('Baru');
            $table->string('warranty')->nullable(); // Contoh: "Garansi Resmi iBox 1 Tahun", "Garansi Toko 1 Bulan"
            
            $table->text('description')->nullable();
            
            // Harga & Stok
            $table->decimal('price', 12, 2)->nullable(); // Harga eceran (bisa diisi saat kurasi)
            $table->integer('wholesale_price')->nullable(); // Modal dari supplier
            $table->string('wholesale_unit')->default('unit'); // Ubah dari 'lusin' ke 'unit' atau 'pcs'
            $table->integer('stock')->default(0);
            
            // Media & Status
            $table->string('image_path')->nullable();
            $table->json('gallery_images')->nullable(); // Langsung digabung di sini
            $table->boolean('is_published')->default(false); // Default sembunyi sampai dikurasi
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};