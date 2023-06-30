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
        Schema::table('students', function (Blueprint $table)  {
            $table->foreignIdFor(\App\Models\User::class,'created_by');
            $table->foreignIdFor(\App\Models\User::class,'updated_by')->nullable();
            $table->foreignIdFor(\App\Models\User::class,'purged_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropColumn('purged_by');
        });
    }
};
