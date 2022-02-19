<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsTableRepositories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('repositories', function (Blueprint $table) {
            $table->string('github_id')->after('id');
            $table->string('url')->after('description');
            $table->string('avatar_url')->after('url');
            $table->string('stargazers_count')->after('avatar_url');
            $table->string('language')->after('stargazers_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('repositories', function (Blueprint $table) {
            $table->dropColumn(['language', 'stargazers_count', 'avatar_url', 'url', 'github_id']);
        });
    }
}
