<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1529490854MatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('matches')) {
            Schema::create('matches', function (Blueprint $table) {
                $table->increments('id');
                $table->datetime('start_time')->nullable();
                $table->integer('result1')->nullable()->unsigned();
                $table->integer('result2')->nullable()->unsigned();
                $table->text('comment')->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
