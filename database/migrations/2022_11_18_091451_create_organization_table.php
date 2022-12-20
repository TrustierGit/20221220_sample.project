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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('domain_organization',30)->comment('自治体ドメイン名');
            $table->integer('mode_reserve')->comment('アカウントフラグ（0:通常/1:常時）')->default(0);
            $table->string('name_organization',100)->comment('自治体名');
            $table->string('stored_server',100)->comment('SplashTop対象サーバー名');
            $table->integer('count_license')->comment('所持ライセンス')->default(0);
            $table->date('date_maintenance')->comment('メンテナンス');
            $table->string('name_file',100)->comment('csvファイル名');
            $table->integer('flag_license')->comment('契約形態（0:一般/1:個別）')->default(0);
            $table->integer('flag_delete')->comment('削除フラグ（0:アクティブ/1:削除）')->default(0);
            $table->timestamps();

            // ユニーク設定
            $table->unique(['domain_organization','mode_reserve']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations');
    }
};
