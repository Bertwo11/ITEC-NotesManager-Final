<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('address')->nullable()->after('profile_picture');
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('address');
            $table->date('birthdate')->nullable()->after('gender');
            $table->string('phone')->nullable()->after('birthdate');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['address', 'gender', 'birthdate', 'phone']);
        });
    }
};