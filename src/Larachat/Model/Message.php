<?php

namespace Vendor\Larachat\Model;

use Illuminate\Database\Eloquent\Model;
use Vendor\Larachat\Traits\Affiliateable;

class Message extends Model{

	/** @var instance  */
    protected static $instance;
    
    /** @var fillable */
    protected $fillable = [
        'to',
        'from',
        'message',
        'is_read',
    ];

    /**
     * Store sent message
     * @param  User $from    User Id
     * @param  User $to      User Id
     * @param  String $message 
     * @return Message          
     */
    public static function send($from,$to,$message){
    	
    	$from = gettype($from) === "object" ? $from->id : $from;

    	$to = gettype($to) === "object" ? $to->id : $to;
    	
    	Message::create([
    		'from' => $from,
    		'to' => $to,
    		'message' => $message,
    	]);

    	return static::getself();
    }

    /**
     * @param  User $user
     * @return Message      
     */
    public static function getUserMessages($user){

    	$user = gettype($user) === "object" ? $user->id : $user;

    	return Message::where('to',$user)->get();
    }
  
    /**
     * @param  Message $message
     * @return Message      
     */
    public static function markAsRead(Message $message){

    	$message->is_read = 1;
    	$message->save();
    	
    	return static::getself();
    }

    /**
     * @param  Message $message
     * @return Message      
     */
    public static function markAsUnread(Message $message){

    	$message->is_read = 0;
    	$message->save();

    	return static::getself();
    }  

    /**
     * @param  Message $message
     * @return Message      
     */
    public static function getReadMessages($user){

        $user = gettype($user) === "object" ? $user->id : $user;

        return Message::where('to' , $user)
            ->where('is_read',1)
            ->get();
    }

    /**
     * @param  Message $message
     * @return Message      
     */
    public static function getUnreadMessages($user){

    	$user = gettype($user) === "object" ? $user->id : $user;

    	return Message::where('to' , $user)
    		->where('is_read',0)
    		->get();
    }

    /**
     * @param  User $user
     * @return Message      
     */
    public static function getSentMessages($user){

    	$user = gettype($user) === "object" ? $user->id : $user;

    	return Message::where('from',$user)->get();
    }

    /**
     * @return Message
     */
    protected static function getself()
    {
        if (static::$instance === null) 
        {
            static::$instance = new Message;
        }

        return static::$instance;
    }
}
