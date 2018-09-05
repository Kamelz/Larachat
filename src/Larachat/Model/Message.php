<?php

namespace Vendor\Larachat\Model;

use Illuminate\Database\Eloquent\Model;
use Vendor\Larachat\Traits\Affiliateable;

class Message extends Model{
    
    protected $fillable = [
        'to',
        'from',
        'message',
        'is_read',
    ];
}
