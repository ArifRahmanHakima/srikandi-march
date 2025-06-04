<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            // Hapus kolom yang tidak digunakan
            $table->dropColumn(['first_name', 'last_name','state']);

            // Tambahkan kolom baru dengan posisi sesuai struktur
            $table->string('full_name')->after('order_id')->nullable();
            $table->string('subdistrict')->after('city')->nullable();
            $table->string('province')->after('street_address')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            // Kembalikan kolom yang dihapus
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();

            // Hapus kolom yang ditambahkan
            $table->dropColumn(['full_name', 'subdistrict', 'province']);
        }); 
    }
};
