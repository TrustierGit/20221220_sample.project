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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('domain_organization',100)->comment('自治体ドメイン名');
            $table->integer('mode_reserve')->comment('アカウントフラグ（0:通常/1:常時）')->default(0);
            $table->date('date_reservation')->comment('予約日');
            $table->string('email_staff')->comment('職員メールアドレス');
            $table->text('text_remarks')->comment('備考欄')->nullable();
            $table->date('created_at')->comment('データ登録日');
            $table->timestamp('updated_at')->comment('データ更新日');

            // ユニーク設定
        $table->unique(['domain_organization','mode_reserve','date_reservation','email_staff'],'reservations_table_unique_keys');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};
