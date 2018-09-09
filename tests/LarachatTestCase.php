<?php

namespace Kamelz\Larachat\Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Kamelz\Larachat\Tests\TestModels\User;
use Kamelz\Larachat\LarachatServiceProvider;

abstract class LarachatTestCase extends TestCase
{
	
	 /**
     * Setup the test environment.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->dropTables();
        $this->setUpUserTable();
        $this->setUpMessageTable();
    }


    protected function getPackageProviders($app)
    {

        return [LarachatServiceProvider::class];
    }

    /**
	 * Define environment setup.
	 *
	 * @param  \Illuminate\Foundation\Application  $app
	 * @return void
	 */
	protected function getEnvironmentSetUp($app)
	{
	    $app['config']->set('database.default', 'chat_package');
	    $app['config']->set('database.connections.chat_package', [
	        'driver'   => 'mysql',
	        'username' => 'root',
	        'database' => 'chat_package',
	        'password' => '',
	        'host' => 'localhost',

	    ]);
	}

	public function setUpUserTable(){
		Schema::create('users', function (Blueprint $table) {
		    $table->increments('id');
		    $table->string('name');
		});
	}	
	public function dropTables(){
		\DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('migrations');
        Schema::dropIfExists('messages');
		Schema::dropIfExists('users');
		\DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

	public function setUpMessageTable(){

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

    public function createUser(){

    	return User::create([
    		'name' => 'test_name',
    	]);
    }
}
