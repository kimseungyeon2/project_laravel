<?php

namespace App\Listeners;

use App\Events\MailSend;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class MailSends
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MailSend  $event
     * @return void
     */
    public function handle(MailSend $event)
    {
      $mail = $event->mail;
      Mail::send(['html'=>'mail'],['name','sitein'],function($message) use ($mail){//이렇게 줘야지만 됨
        $message->to($mail,'ToSeungyeon')->subject('Test Email');
        $message->from('asd07964@gmail.com','hellow');
      });
    }
}
