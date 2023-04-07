<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

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
            $user_id = Auth::user()->id;

            $login_time_id = DB::table('logs')
            ->where('user_id' ,'=',$user_id)
            ->max('id');

            $info = ['logout'];
            $logout_info = json_encode($info);

            $login_time = Log::find($login_time_id)->login_time;
            
            Log::create(
            [
            'user_id' => $user_id,
            'email' => $event->user->email,
            'ip_address' => request()->ip(),
            'info' => $logout_info,
            'user_agent' => request()->userAgent(),
            'login_time' => $login_time

        ]
            );
        }
}
