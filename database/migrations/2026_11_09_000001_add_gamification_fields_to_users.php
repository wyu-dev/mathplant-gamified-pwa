<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // New fields for gamification
            $table->string('ic_no', 12)->unique()->after('email');
            $table->string('ndp', 20)->unique()->after('ic_no');
            $table->string('course')->after('ndp');
            $table->unsignedBigInteger('xp')->default(0)->after('course');
            $table->unsignedInteger('uptime_streak')->default(0)->after('xp');
            $table->date('last_activity_date')->nullable()->after('uptime_streak');
            $table->string('rank_title')->default('Apprentice Technician')->after('last_activity_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'ic_no',
                'ndp',
                'course',
                'xp',
                'uptime_streak',
                'last_activity_date',
                'rank_title',
            ]);
        });
    }
};
