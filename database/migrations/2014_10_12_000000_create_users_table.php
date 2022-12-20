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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->comment('職員メールアドレス')->unique();
            $table->string('domain_organization',100)->comment('自治体ドメイン名');
            $table->integer('mode_reserve')->comment('アカウントフラグ（0:通常/1:常時）')->default(0);
            $table->string('name')->comment('ユーザー名');
            $table->string('password')->comment('ログインパスワード');
            $table->tinyInteger('mode_admin')->comment('管理者モード(0:一般/1:自治体/9:NESIC)');
            $table->integer('flag_delete')->comment('削除フラグ（0:アクティブ/1:削除）')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
