<?php
namespace app\Listeners;

use App\Events\LoginUser;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Log;

class UserSubscribe
{

    public function subscribe(Dispatcher $event)
    {
        $event->listen(LoginUser::class, 'app\Listeners\UserSubscribe@emailUser');
        $event->listen(LoginUser::class, 'app\Listeners\UserSubscribe@welcomeLoginlUser');
    }

    public function EmailUser(LoginUser $event)
    {
        Log::info('سلام به ایمیلت خوش آمدید' . $event->user->name);
    }

    public function WelcomeLoginlUser(LoginUser $event)
    {
        Log::info('سلام به ایمیلت خوش آمدید' . $event->user->name);
    }
}