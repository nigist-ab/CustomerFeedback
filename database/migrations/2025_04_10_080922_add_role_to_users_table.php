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
            

            // add new column
            $table->enum('role', ['admin', 'agent', 'customer'])->default('customer')->after('password');
        });
    }

    /**
     * Reverse the migrations.$table->enum('role', ['admin', 'agent', 'customer'])->default('customer')
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
