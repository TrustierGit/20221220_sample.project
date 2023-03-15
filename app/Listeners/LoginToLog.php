<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use App\Models\AuthHistory;

class LoginToLog
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
     * @param  \App\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
	    AuthHistory::create(
        [
	    'user_id' => $event->user->id,
	    'email' => $event->user->email,
        'ip_address' => request()->ip(),
        'info' => 'login',
        'user_agent' => request()->userAgent(),
	    'login_time' => \Carbon\Carbon::now()

	    //'operation_type' =>null;
	]
	    );
    }
}
