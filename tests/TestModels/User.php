<?php

namespace Kamelz\Larachat\Tests\TestModels;

use Illuminate\Database\Eloquent\Model;
use Kamelz\Larachat\Traits\Affiliateable;

class User extends Model{
    
    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
