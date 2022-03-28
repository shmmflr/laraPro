<?php

namespace App\Listeners;

use App\Events\LoginUser;
use Illuminate\Support\Facades\Log;

class WelcomeLoginUser
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
     * @param  \App\Events\LoginUser  $event
     * @return void
     */
    public function handle(LoginUser $event)
    {
        Log::info('سلام عزیزم خوش آمدید' . $event->user->name);
    }
}