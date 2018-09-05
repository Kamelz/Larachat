<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateAffiliateTable extends Migration
{
    public $userTableName; 

    public $affiliateTableName; 
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TODO refactor this
  
        $config = app()->config['Laraffiliate'];

        $userModelName =  substr($config['user_model']['name'],strrpos($config['user_model']['name'], '\\')+1);

        $affiliateModelName =  substr($config['affiliate_model']['name'],strrpos($config['affiliate_model']['name'], '\\')+1);

        $this->userTableName = Str::plural(strtolower($userModelName ?? 'users'));

        $this->affiliateTableName = Str::plural(strtolower($affiliateModelName ?? 'affiliate_payments'));

        $method  = Schema::hasTable($this->userTableName)? 'table' : 'create';

        Schema::$method($this->userTableName, function (Blueprint $table) use($config){
            
            $affiliateCoulmn = $config['affiliate_model']['column']??'affiliate_id';
            $table->increments('id');  
            $table->string('email');  
            $table->string($affiliateCoulmn)->unique();  

            $table->unsignedInteger('referred_by')->nullable();  
            $table->foreign('referred_by')
            ->references('id')->on($this->affiliateTableName);  
        });    
    }
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->userTableName);
    }
}
