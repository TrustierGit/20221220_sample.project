<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Organization;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Exceptions\Handler;
use App\Http\Controllers\AutoReservationController;
use App\Exceptions\UserException;


class AutoReservationController extends Controller
{
    private $message;

     /**★ストアドプロシージャ呼び出し
         * 注意：@msgはストアドプロシージャ内でのOUTPUT（戻り値）を格納する変数
         戻り値を取得するために再度DB::selectで取得
         */
        public function AutoReservation(){
            $message=''; 
            $array=[
                '2023-01-28',
            ];
            DB::statement('CALL AUTO_RESERVATION(?,@msg)',$array);
            $result1 = DB::select('SELECT @msg AS result');
            $message = $result1[0]->result; 
            return $message;
            }
}
