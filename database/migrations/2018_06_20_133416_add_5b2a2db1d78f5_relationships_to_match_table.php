<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b2a2db1d78f5RelationshipsToMatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matches', function(Blueprint $table) {
            if (!Schema::hasColumn('matches', 'team1_id')) {
                $table->integer('team1_id')->unsigned()->nullable();
                $table->foreign('team1_id', '174540_5b2a2dac7e2b3')->references('id')->on('teams')->onDelete('cascade');
                }
                if (!Schema::hasColumn('matches', 'team2_id')) {
                $table->integer('team2_id')->unsigned()->nullable();
                $table->foreign('team2_id', '174540_5b2a2dac95128')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('matches', function(Blueprint $table) {
            
        });
    }
}
