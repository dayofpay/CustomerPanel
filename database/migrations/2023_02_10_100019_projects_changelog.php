<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects_changelog', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('project_id');
            $table->string('project_log_id');
            $table->string('project_log_date');
            $table->string('project_log_information');
            $table->string('project_log_note');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('');
        });
    }
};
