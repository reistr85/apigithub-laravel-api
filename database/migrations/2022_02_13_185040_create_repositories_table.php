<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepositoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repositories', function (Blueprint $table) {
            $table->id();
            $table->string('github_id');
            $table->string('name');
            $table->text('description');
            $table->string('url')->after('description');
            $table->string('avatar_url')->after('url');
            $table->string('stargazers_count')->after('avatar_url');
            $table->string('language')->after('stargazers_count');

            $table->string('situation')->default('active');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repositories');
    }
}
