<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_comments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('post_id')
                ->unsigned()
                ->nullable(false)
                ->comment('Post');

            $table->bigInteger('author_id')
                ->unsigned()
                ->nullable(false)
                ->comment('Comment Author');

            $table->longText('comment')
                ->nullable(false)
                ->comment('Comment');

            $table->foreign('post_id', 'post_comment_to_post_foreign')
                ->on('posts')
                ->references('id')
                ->onDelete('cascade');

            $table->foreign('author_id', 'post_comment_to_user_foreign')
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
        Schema::table('post_comments', function (Blueprint $table) {
            $table->dropForeign('post_comment_to_post_foreign');
            $table->dropForeign('post_comment_to_user_foreign');
        });

        Schema::dropIfExists('post_comments');
    }
}
