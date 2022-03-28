<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    // protected $listen = [
    //     Registered::class => [
    //         SendEmailVerificationNotification::class,
    //     ],
    //     LoginUser::class => [
    //         '\App\Listeners\WelcomeLoginUser',
    //         '\App\Listeners\EmailUser',
    //     ],

    // ];

    protected $subscribe = [
        'App\Listeners\UserSubscribe',
    ];

    public function boot()
    {

    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}