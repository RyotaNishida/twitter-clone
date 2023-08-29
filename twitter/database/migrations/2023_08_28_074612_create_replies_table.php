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
        Schema::create('replies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('ユーザーID');
            $table->unsignedInteger('tweet_id')->comment('ツイートID');
            $table->string('content')->comment('コメント本文');
            $table->softDeletes();

            $table->timestamps();

            $table->foreign('user_id') // users テーブルの id カラムと関連付けられる外部キー
                ->references('id') // 外部キーが参照するカラムを指定。この場合、user_idカラムが usersテーブルのidカラムを参照します。
                ->on('users') //外部キーが参照するテーブルを指定します。この場合、user_idカラムがusersテーブルを参照。
                ->onDelete('cascade') // 親テーブルのレコードが削除（または更新）された場合に、子テーブルの該当するレコードも一緒に削除する動作を定義します。
                ->onUpdate('cascade'); // この場合、users テーブルの特定のユーザが削除された際に、関連するツイートも削除されます。

            $table->foreign('tweet_id')
                ->references('id')
                ->on('tweets')
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
        Schema::dropIfExists('replies');
    }
};
