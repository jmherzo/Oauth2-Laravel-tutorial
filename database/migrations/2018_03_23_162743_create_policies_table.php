<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policies', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('policy')->nullable();
            $table->integer('section_id')->unsigned();
            $table->boolean('role1')->default(false);
            $table->boolean('role2')->default(false);
            $table->boolean('role3')->default(false);
            $table->boolean('role4')->default(false);
            $table->boolean('role5')->default(false);
            $table->boolean('role6')->default(false);
            $table->boolean('role7')->default(false);
            $table->boolean('role8')->default(false);
            $table->boolean('role9')->default(false);
            $table->boolean('role10')->default(false);
            $table->boolean('role11')->default(false);
            $table->boolean('role12')->default(false);
            $table->boolean('role13')->default(false);
            $table->boolean('role14')->default(false);
            $table->boolean('role15')->default(false);
            $table->boolean('role16')->default(false);
            $table->boolean('role17')->default(false);
            $table->boolean('role18')->default(false);
            $table->boolean('role19')->default(false);
            $table->boolean('role20')->default(false);
            $table->boolean('role21')->default(false);
            $table->boolean('role22')->default(false);
            $table->foreign('section_id')->references('id')->on('sections');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('policies');
    }
}
