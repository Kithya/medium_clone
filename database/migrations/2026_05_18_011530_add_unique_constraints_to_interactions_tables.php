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
        Schema::table('followers', function (Blueprint $table) {
            $table->unique(['user_id', 'follower_id'], 'followers_user_id_follower_id_unique');
        });

        Schema::table('claps', function (Blueprint $table) {
            $table->unique(['user_id', 'post_id'], 'claps_user_id_post_id_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('claps', function (Blueprint $table) {
            $table->dropUnique('claps_user_id_post_id_unique');
        });

        Schema::table('followers', function (Blueprint $table) {
            $table->dropUnique('followers_user_id_follower_id_unique');
        });
    }
};
