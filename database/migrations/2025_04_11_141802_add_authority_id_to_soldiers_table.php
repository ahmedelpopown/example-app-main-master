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
        Schema::table('soldiers', function (Blueprint $table) {
            if (!Schema::hasColumn('soldiers', 'authority_id')) {
                $table->foreignId('authority_id')->nullable()->constrained()->onDelete('set null');
            }
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('soldiers', function (Blueprint $table) {
            // التأكد من اسم المفتاح الخارجي الصحيح
             $table->dropColumn('authority_id');
        });
    }
    
};
