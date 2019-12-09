<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_components', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->biginteger('issue_id')->unsigned();
            $table->biginteger('component_id')->unsigned();
            $table->foreign('issue_id')->references('id')->on('issues');
            $table->foreign('component_id')->references('id')->on('components');
            
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
        Schema::dropIfExists('issue_components');
    }
}
