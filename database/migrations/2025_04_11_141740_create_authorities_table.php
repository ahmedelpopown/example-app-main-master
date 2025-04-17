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
        Schema::create('authorities', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // اسم الجهة
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('authorities', function (Blueprint $table) {
            Schema::drop('authorities'); // حذف الجدول
        });
     }
};
