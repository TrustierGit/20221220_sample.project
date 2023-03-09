<?php

namespace App\Listeners;

//use App\Events\Lockout;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LockoutToLog
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
     * @param  \App\Events\Lockout  $event
     * @return void
     */
    public function handle(Lockout $event)
    {
        logger()->info($event->request->all());
    }
}
