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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email_verified_at');
            $table->text('bio')->nullable()->after('phone');
            $table->string('profile_photo_path')->nullable()->after('bio');
            $table->string('country')->nullable()->after('profile_photo_path');
            $table->string('city')->nullable()->after('country');
            $table->string('state')->nullable()->after('city');
            $table->string('code_post')->nullable()->after('state');
            $table->string('street_address')->nullable()->after('code_post');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'bio',
                'profile_photo_path',
                'country',
                'city',
                'state',
                'code_post',
                'street_address'
            ]);
        });
    }
};