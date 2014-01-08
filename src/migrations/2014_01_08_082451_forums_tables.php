<?php namespace Connor4312\LaravelForums;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ForumsTables extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creates the topics table
        Schema::create('f_categories', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->integer('stat_views')->unsigned()->default(0);
            $table->integer('parent_id')->default(-1);
            $table->integer('order')->default(0);
            $table->text('description');
            $table->timestamps();
        });

        // Creates the topics table
        Schema::create('f_topics', function($table)
        {
            $table->increments('id')->unsigned();
            $table->foreign('category_id')->references('id')->on('f_categories');
            $table->foreign('profile_id')->references('id')->on('f_profiles');
            $table->string('title');
            $table->enum('state', array('open', 'locked', 'sticky', 'moved'))->default('open');
            $table->integer('stat_views')->unsigned()->default(0);
            $table->integer('stat_posts')->unsigned()->default(0);
            $table->text('content');
            $table->timestamps();
        });

        // Creates the topics table
        Schema::create('f_replies', function($table)
        {
            $table->increments('id')->unsigned();
            $table->foreign('profile_id')->references('id')->on('f_profiles');
            $table->foreign('topic_id')->references('id')->on('f_topics');
            $table->foreign('responding_id')->unsigned()->nullable();
            $table->integer('likes')->unsigned()->default(0);
            $table->text('content');
            $table->timestamps();
        });

        // Creates the topics table
        Schema::create('f_notifications', function($table)
        {
            $table->increments('id')->unsigned();
            $table->foreign('profile_id')->references('id')->on('f_profiles');
            $table->boolean('viewed');
            $table->string('slug', '25');
            $table->string('title', '100');
            $table->timestamps();
        });

        // Creates the topics table
        Schema::create('f_profiles', function($table)
        {
            $table->increments('id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users'); // assumes a users table
            $table->integer('rep')->unsigned()->default(0);
            $table->integer('posts')->unsigned()->default(0);
            $table->boolean('notify_reply');
            $table->boolean('notify_message');
            $table->boolean('notify_mention');
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
        Schema::drop('assigned_roles');
        Schema::drop('permission_role');
        Schema::drop('roles');
        Schema::drop('permissions');
    }

}
