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
    Schema::table('counselors', function (Blueprint $table) {
        // Menambahkan foreign key user_id yang terhubung ke tabel users
        $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('counselors', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });
}
};
