<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use App\Models\AuthHistory;

class LogoutToLog
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
         * @param  \App\Events\Logout  $event
         * @return void
         */
        public function handle(Logout $event)
        {
            // $session_id = DB::table('auth_histories')
            //                 ->where('email' ,'=',$event->user->email)
            //                 ->max('id');
            // $login_time =  Auth_history::find($session_id)->login_time;

            AuthHistory::create(
            [
            'user_id' => $event->user->id,
            'email' => $event->user->email,
            'ip_address' => request()->ip(),
            'info' => 'logout',
            'user_agent' => request()->userAgent(),
            // 'login_time' => $login_time
            //★login時間をもってきたい
                            
    
            //'operation_type' =>null;
        ]
            );
        }
}
