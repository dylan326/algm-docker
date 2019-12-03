<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueComponetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_componets', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->biginteger('issue_id')->unsigned();
            $table->biginteger('componet_id')->unsigned();
            $table->foreign('issue_id')->references('id')->on('issues');
            $table->foreign('componet_id')->references('id')->on('componets');
            
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
        Schema::dropIfExists('issue_componets');
    }
}
