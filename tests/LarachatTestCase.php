<?php

namespace Vendor\Package\Tests;

use Vendor\Package\PackageServiceProvider;
use Orchestra\Testbench\TestCase;
use Vendor\Larachat\Tests\TestModels\User;

abstract class PackageTestCase extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [PackageServiceProvider::class];
    public function createUser(){

    	return User::create([
    		'name' => 'test_name',
    	]);
    }
}
