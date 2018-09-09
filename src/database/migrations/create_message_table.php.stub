<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('messages', function (Blueprint $table){
            
            $table->increments('id');  
            $table->unsignedInteger('from')->nullable();  
            $table->unsignedInteger('to')->nullable();  
            $table->string('message');  
            $table->integer('is_read')->default(0);  
            $table->foreign('from')
            ->references('id')->on('users');
           $table->foreign('to')
            ->references('id')->on('users');  
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
        Schema::dropIfExists('messages');
    }
}
