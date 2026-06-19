<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['owner', 'manager', 'supervisor', 'kasir', 'gudang'])->default('kasir');
            $table->foreignId('cabang_id')->nullable()->after('role')->constrained('cabangs')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['cabang_id']);
            $table->dropColumn(['role', 'cabang_id']);
        });
    }
};