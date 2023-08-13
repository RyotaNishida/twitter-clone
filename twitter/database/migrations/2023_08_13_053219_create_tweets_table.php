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

        Schema::create('tweets', function (Blueprint $table) {

            $table->increments('id');
            // unsignedInteger は、符号なし整数を表すカラムを作成するためのメソッドです。
            // 符号なし整数は、負の値を持たない整数のことを指します。通常、主キーや外部キーの ID などに使用されます。
            $table->unsignedInteger('user_id')->comment('ユーザーID');
            $table->string('content')->comment('本文');
            $table->softDeletes();
            $table->timestamps();

            // インデックスの作成
            $table->index('id');
            $table->index('user_id');
            $table->index('content');

            $table->foreign('user_id') // users テーブルの id カラムと関連付けられる外部キー
            ->references('id') // 外部キーが参照するカラムを指定。この場合、user_idカラムが usersテーブルのidカラムを参照します。
            ->on('users') //外部キーが参照するテーブルを指定します。この場合、user_idカラムがusersテーブルを参照。
            ->onDelete('cascade')
            ->onUpdate('cascade');
            // 親テーブルのレコードが削除（または更新）された場合に、子テーブルの該当するレコードも一緒に削除する動作を定義します。
            // この場合、users テーブルの特定のユーザが削除された際に、関連するツイートも削除されます。
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tweets');
    }
};
