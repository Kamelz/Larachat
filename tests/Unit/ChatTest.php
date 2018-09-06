<?php

namespace Vendor\Larachat\Tests\Unit;
use Vendor\Larachat\Model\Message;
use Vendor\Larachat\Tests\TestModels\User;
use Vendor\Larachat\Tests\LarachatTestCase;

class ChatTest extends LarachatTestCase
{
	/**
	* Setup the test environment.
	*
	* @return void
	*/
    protected function setUp(){

		parent::setUp();
    }

    /**
     * @test
     * @return void
     */
    public function it_can_send_message_to_user()
    {
        $message = $this->makeMessage();
        $messages = Message::first();

        $this->assertSame($message['from']->id,$messages->from);
        $this->assertSame($message['to']->id,$messages->to);
        $this->assertSame($message['content'],$messages->message);
    }

    /**
     *
     * @test
     * @return void
     */
    public function it_can_receive_all_messages()
    {
        $message = $this->makeMessage();   
        $messages = Message::getUserMessages($message['to']);
        dd($messages);
        $this->assertSame($message['from']->id,$messages[0]['from']);
        $this->assertSame($message['to']->id,$messages[0]['to']);
        $this->assertSame($message['content'],$messages[0]['message']);
    }

    /**
     *
     * @test
     * @return void
     */
    public function it_can_receive_sent_messages()
    {
        $message = $this->makeMessage();
      
        $messages = Message::getSentMessages($message['from']);
        $this->assertSame($message['from']->id,$messages[0]['from']);
        $this->assertSame($message['to']->id,$messages[0]['to']);
        $this->assertSame($message['content'],$messages[0]['message']);
    }


    /**
     * @test
     * @return void
     */
    public function it_can_mark_message_as_read()
    {
        $message = $this->makeMessage();
        Message::markAsRead($message['model']);
        $this->assertSame(1,$message['model']->fresh()->is_read);
    }

    /**
     * @test
     * @return void
     */
    public function it_can_mark_message_as_unread()
    {
        $message = $this->makeMessage();
        Message::markAsUnread($message['model']);
        $this->assertSame(0,$message['model']->fresh()->is_read);
    }


    /**
     * @todo
     * @test
     * @return void
     */
    public function it_can_receive_read_messages()
    {

        $message = $this->makeMessage();

        Message::markAsRead($message['model']);

        //unread message
        Message::send(
            $message['from'],
            $message['to'],
            'unread_message'
        );

        $messages = Message::getReadMessages($message['to']);

        $this->assertSame(1,$messages->count());
        $this->assertNotSame('unread_message',$messages->first()->message);
    }

    /**
     * @todo
     * @test
     * @return void
     */
    public function it_can_receive_unread_messages()
    {
        $message = $this->makeMessage();
        
        Message::markAsUnread($message['model']);

           //unread message
        Message::send(
            $message['from'],
            $message['to'],
            'read_message'
        );

        $readMessage = Message::where('message','read_message')->first();
        $readMessage->is_read = 1;  
        $readMessage->save();  

        $messages = Message::getUnreadMessages($messages['model']);

        $this->assertSame(1,$messages->count());
        $this->assertNotSame('read_message',$messages->first()->message);
    }

    public function makeMessage(){
        $message = [
            'from'    => $this->createUser(),
            'to'      => $this->createUser(),
            'content' => "test_message"
        ];
        Message::send(
            $message['from'],
            $message['to'],
            $message['content']
        );

        $model = Message::where('to',$message['to']->id)->first();

        return ['model' => $model] + $message;
    }
}
