<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('author_id')
                ->unsigned()
                ->nullable(false)
                ->comment('Author ID');

            $table->string('title')
                ->nullable(false)
                ->comment('Title');

            $table->longText('description')
                ->nullable(false)
                ->comment('Description');

            $table->foreign('author_id', 'post_to_user_foreign')
                ->on('users')
                ->references('id')
                ->onDelete('cascade');

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
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('post_to_user_foreign');
        });

        Schema::dropIfExists('posts');
    }
}
