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
        // Tabel tb_company (harus dibuat terlebih dahulu karena direlasikan ke tabel lain)
        Schema::create('tb_company', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_users')->unsigned();
            $table->string('company', 255)->nullable();
            $table->string('country', 255)->nullable();
            $table->longText('description')->nullable();
            $table->string('field', 255)->nullable();
            $table->string('linkedin', 255)->nullable();
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();

            // Index dan foreign key
            $table->index('id_users', 'fk_company_users');
            $table->foreign('id_users')
                  ->references('id')
                  ->on('tb_users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        // Tabel tb_articles
        Schema::create('tb_articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_users')->unsigned();
            $table->string('title', 255);
            $table->text('banner')->nullable();
            $table->longText('content');
            $table->enum('status', ['pending', 'approve'])->default('pending');
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();

            // Index dan foreign key
            $table->index('id_users', 'idx_articles_id_users');
            $table->foreign('id_users')
                  ->references('id')
                  ->on('tb_users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        // Tabel tb_pr
        Schema::create('tb_pr', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_company')->unsigned();
            $table->string('title', 255)->nullable();
            $table->string('URL', 255)->nullable();
            $table->string('author', 255)->nullable();
            $table->enum('status', ['On Progress', 'Completed', 'Canceled'])->default('On Progress');
            $table->timestamp('created_at')->useCurrent()->nullable();
            // Gunakan useCurrentOnUpdate() jika versi Laravel mendukung
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->nullable();

            // Index dan foreign key
            $table->index('id_company', 'fk_company_pr');
            $table->foreign('id_company')
                  ->references('id')
                  ->on('tb_company')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        // Tabel tb_project
        Schema::create('tb_project', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_company')->unsigned();
            $table->string('project_name', 255);
            $table->longText('description');
            $table->string('category', 255);
            $table->enum('status', ['On Progress', 'Complete', 'Canceled'])->default('On Progress');
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();

            // Index dan foreign key
            $table->index('id_company', 'idx_project_id_company');
            $table->foreign('id_company')
                  ->references('id')
                  ->on('tb_company')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        // Tabel tb_talent
        Schema::create('tb_talent', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_users')->unsigned();
            $table->string('field', 255);
            $table->string('linkedin', 255)->nullable();
            $table->string('url_portfolio', 255);
            $table->string('token', 255)->default('3');
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();

            // Index dan foreign key
            $table->index('id_users', 'fk_talent_users');
            $table->foreign('id_users')
                  ->references('id')
                  ->on('tb_users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        // Tabel tb_task
        Schema::create('tb_task', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_project')->unsigned();
            $table->integer('id_project_manager')->unsigned();
            $table->string('task_title', 255);
            $table->date('deadline');
            $table->enum('status', ['completed', 'in progress', 'unfinish'])->default('unfinish');
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();

            // Index dan foreign key
            $table->index('id_project_manager', 'fk_task_pm');
            $table->index('id_project');
            $table->foreign('id_project_manager')
                  ->references('id')
                  ->on('tb_users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            // Foreign key untuk id_project (tanpa aksi ON DELETE/UPDATE khusus)
            $table->foreign('id_project')
                  ->references('id')
                  ->on('tb_project');
        });

        // Tabel tb_task_list
        Schema::create('tb_task_list', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_task')->unsigned();
            $table->string('task_name', 255)->nullable();
            $table->enum('status', ['completed', 'in progress', 'unfinish'])->default('unfinish');
            $table->text('note')->nullable();
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();

            // Index dan foreign key
            $table->index('id_task', 'fk_tasklist_task');
            $table->foreign('id_task')
                  ->references('id')
                  ->on('tb_task')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        // Tabel tb_team
        Schema::create('tb_team', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_talent')->unsigned();
            $table->integer('id_projects')->unsigned();
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();

            // Index dan foreign key
            $table->index('id_projects', 'fk_team_project');
            $table->index('id_talent', 'fk_team_talent');
            $table->foreign('id_projects')
                  ->references('id')
                  ->on('tb_project')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('id_talent')
                  ->references('id')
                  ->on('tb_talent')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Urutan drop harus memperhatikan foreign key (drop dari tabel yang paling bergantung terlebih dahulu)
        Schema::dropIfExists('tb_team');
        Schema::dropIfExists('tb_task_list');
        Schema::dropIfExists('tb_task');
        Schema::dropIfExists('tb_talent');
        Schema::dropIfExists('tb_project');
        Schema::dropIfExists('tb_pr');
        Schema::dropIfExists('tb_articles');
        Schema::dropIfExists('tb_company');
    }
};
