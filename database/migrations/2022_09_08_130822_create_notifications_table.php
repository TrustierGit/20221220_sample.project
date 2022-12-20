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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->integer('flag_display')->comment('全体周知系');
            $table->string('domain_organization',100)->comment('自治体ドメイン');
            $table->integer('mode_reserve')->comment('アカウントフラグ（0:通常/1:常時）')->default(0);
            $table->date('date_post')->comment('投稿日時');
            $table->text('text_title')->comment('投稿タイトル');
            $table->text('text_message')->comment('投稿メッセージ');
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
        Schema::dropIfExists('notifications');
    }
};
