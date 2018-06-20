<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b2a2e39b8d55RelationshipsToPredictionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('predictions', function(Blueprint $table) {
            if (!Schema::hasColumn('predictions', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '174541_5b2a2e3492f29')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('predictions', 'match_id')) {
                $table->integer('match_id')->unsigned()->nullable();
                $table->foreign('match_id', '174541_5b2a2e34aa7c2')->references('id')->on('matches')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('predictions', function(Blueprint $table) {
            
        });
    }
}
