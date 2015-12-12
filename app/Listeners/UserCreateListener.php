<?php

namespace App\Listeners;

use App\Events\UserCreate;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class UserCreateListener
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
     * @param  UserCreate  $event
     * @return void
     */
    public function handle(UserCreate $event)
    {
        $data = [
            'username'    =>  $event->_user->username,
            'email'     =>  $event->_user->email
        ];
        //发送邮件
        Mail::send('email.default', $data, function ($message) use($data)
        {
            $message->to($data['email'], $data['username'])->subject('laravel社区');
        });
    }
}
