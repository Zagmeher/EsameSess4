<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('auth') && !Schema::hasColumn('auth', 'inizioSfida')) {
            Schema::table('auth', function (Blueprint $table) {
                $table->timestamp('inizioSfida')->nullable()->after('sfida');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('auth') && Schema::hasColumn('auth', 'inizioSfida')) {
            Schema::table('auth', function (Blueprint $table) {
                $table->dropColumn('inizioSfida');
            });
        }
    }
};
