<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Multi-Aktor Demo (Disesuaikan untuk Toko HP)
        $admin = User::create([
            'name' => 'Admin MZ Store 85',
            'email' => 'admin@mzstore85.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        $supplierResmi = User::create([
            'name' => 'Distributor iBox Indonesia',
            'email' => 'ibox@supplier.com',
            'password' => Hash::make('supplier'),
            'role' => 'supplier',
            'brand_name' => 'iBox Authorized',
            'contact' => '+62 811-2233-4455',
        ]);

        $supplierSecond = User::create([
            'name' => 'Mitra Ponsel Second',
            'email' => 'mitra@supplier.com',
            'password' => Hash::make('supplier'),
            'role' => 'supplier',
            'brand_name' => 'MPS Gadget',
            'contact' => '+62 822-3344-5566',
        ]);

        $customerBudi = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('buyer'),
            'role' => 'customer',
            'contact' => '+62 899-7000-8000',
        ]);

        // 2. Buat Kategori Gadget
        $catApple = Category::create(['name' => 'Apple iPhone', 'slug' => 'apple-iphone', 'description' => 'Kumpulan produk Apple iPhone Baru dan Bekas.']);
        $catSamsung = Category::create(['name' => 'Samsung Galaxy', 'slug' => 'samsung-galaxy', 'description' => 'Kumpulan produk Samsung Android Baru dan Bekas.']);

        // 3. Buat Produk Sampel 1: HP BARU (BNIB)
        $prod1 = Product::create([
            'supplier_id' => $supplierResmi->id,
            'supplier_brand' => 'iBox Authorized',
            'sku' => 'IP15-PM-001',
            'name' => 'iPhone 15 Pro Max',
            'slug' => 'iphone-15-pro-max',
            'category_id' => $catApple->id,
            'condition' => 'Baru',                               // Fitur Baru
            'warranty' => 'Garansi Resmi iBox 1 Tahun',          // Fitur Baru
            'description' => 'iPhone 15 Pro Max kondisi BNIB (Brand New In Box) segel Greenpeel. Garansi resmi iBox Indonesia.',
            'wholesale_price' => 22000000,                       // Modal per unit
            'wholesale_unit' => 'unit',                          // Satuan
            'price' => 24500000,                                 // Harga Jual Ecer
            'stock' => 15,
            'image_path' => 'https://images.unsplash.com/photo-1696446701796-da61225697cc?w=500&q=80',
            'gallery_images' => [ 
                'https://images.unsplash.com/photo-1695048133142-1a20484d2569?w=500&q=80'
            ],
            'is_published' => true,
        ]);

        // Varian Produk 1 (Kapasitas & Warna)
        ProductVariant::create(['product_id' => $prod1->id, 'name' => '256GB - Natural Titanium', 'sku' => 'IP15-PM-256-NT', 'price' => 24500000, 'stock' => 10]);
        ProductVariant::create(['product_id' => $prod1->id, 'name' => '512GB - Black Titanium', 'sku' => 'IP15-PM-512-BT', 'price' => 28000000, 'stock' => 5]);

        // 4. Buat Produk Sampel 2: HP BEKAS (Second)
        $prod2 = Product::create([
            'supplier_id' => $supplierSecond->id,
            'supplier_brand' => 'MPS Gadget',
            'sku' => 'S23-ULTRA-SEC',
            'name' => 'Samsung Galaxy S23 Ultra (Bekas)',
            'slug' => 'samsung-galaxy-s23-ultra-bekas',
            'category_id' => $catSamsung->id,
            'condition' => 'Bekas',                              // Fitur Baru
            'warranty' => 'Garansi Toko 1 Bulan',                // Fitur Baru
            'description' => 'Samsung S23 Ultra second like new. Mulus 98%, no minus, baterai awet. Kelengkapan fullset original.',
            'wholesale_price' => 13000000, 
            'wholesale_unit' => 'unit', 
            'price' => 14500000, 
            'stock' => 3,
            'image_path' => 'https://images.unsplash.com/photo-1678911820864-e2c567c655d7?w=500&q=80',
            'gallery_images' => [],
            'is_published' => true,
        ]);

        // Varian Produk 2 (Kapasitas & Warna)
        ProductVariant::create(['product_id' => $prod2->id, 'name' => '12GB/256GB - Phantom Black', 'sku' => 'S23-ULTRA-SEC-12-256-PB', 'price' => 14500000, 'stock' => 3]);
    }
}