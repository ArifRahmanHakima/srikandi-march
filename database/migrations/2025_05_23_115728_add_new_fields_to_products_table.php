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
        Schema::table('products', function (Blueprint $table) {
            $table->string('sku')->unique()->after('slug');
            $table->string('color')->nullable()->after('sku');
            $table->string('size')->nullable()->after('color');
            $table->string('material')->nullable()->after('size');
            $table->string('pattern')->nullable()->after('material'); // motif
            $table->decimal('weight', 8, 2)->nullable()->after('pattern'); // berat dalam kg
            $table->string('warranty')->nullable()->after('weight'); // garansi
            $table->boolean('is_new')->default(false)->after('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
             $table->dropColumn([
                'sku',
                'color',
                'size',
                'material',
                'pattern',
                'weight',
                'warranty',
                'is_new'
            ]);
        });
    }
};
