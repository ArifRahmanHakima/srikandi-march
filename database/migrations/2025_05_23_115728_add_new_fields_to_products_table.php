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
            if (!Schema::hasColumn('products', 'sku')) {
                $table->string('sku')->unique()->after('slug');
            }
            if (!Schema::hasColumn('products', 'color')) {
                $table->string('color')->nullable()->after('sku');
            }
            if (!Schema::hasColumn('products', 'size')) {
                $table->string('size')->nullable()->after('color');
            }
            if (!Schema::hasColumn('products', 'material')) {
                $table->string('material')->nullable()->after('size');
            }
            if (!Schema::hasColumn('products', 'pattern')) {
                $table->string('pattern')->nullable()->after('material');
            }
            if (!Schema::hasColumn('products', 'weight')) {
                $table->decimal('weight', 8, 2)->nullable()->after('pattern');
            }
            if (!Schema::hasColumn('products', 'warranty')) {
                $table->string('warranty')->nullable()->after('weight');
            }
            if (!Schema::hasColumn('products', 'is_new')) {
                $table->boolean('is_new')->default(false)->after('is_featured');
            }
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
