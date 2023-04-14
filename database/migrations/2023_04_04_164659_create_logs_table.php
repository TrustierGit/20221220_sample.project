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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
		    $table->string('user_id')->nullable();
	        $table->string('email')->nullable();
            $table->string('ip_address')->nullable();
            $table->json('info')->comment('アクション');
            $table->text('user_agent')->nullable();
	        $table->timestamp('login_time')->nullable();
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
        Schema::dropIfExists('logs');
    }
};