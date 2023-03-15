<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\LockoutToLog;
use App\Listeners\LoginToLog;
use App\Listeners\LogoutToLog;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
	],
	    Lockout::class => [
            LockoutToLog::class,
        ],
        Login::class => [
            LoginToLog::class,
        ],
        Logout::class => [
                LogoutToLog::class,
        ],
    ];
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
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

    public function handle(Lockout $event)
	{
    		logger()->info($event->request->all());
	}
}

