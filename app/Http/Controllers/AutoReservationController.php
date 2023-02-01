<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AutoReservationController;

/**
 * 
 * @property String $message
 * @property Carbon $datetime
 */
class AutoReservationController extends Controller
{
    private $message;
    private $datetime;

    /**
     * コンストラクタ
     */
    function __construct(){
		$this->datetime = new Carbon();
		$this->message = '';
	}
    /**
     * AutoReservation
     * 
     * @param Request $request->days
     * @return String $this->message 
     * 
     * ★ストアドプロシージャ呼び出し
     * 注意：@msgはストアドプロシージャ内でのOUTPUT（戻り値）を格納する変数
     * 戻り値を取得するために再度DB::selectで取得
     */
    public function AutoReservation(Request $request){

        $this->message = '';
        // Getパラメータがない場合（$request->daysがNULL）は、翌日日付を挿入
        $target_date = !is_null($request->days) ? $request->days : $this->datetime::tomorrow()->format('Y-m-d');
        // 日付チェックエラーの場合は、登録処理をしない
        if($this->is_date($target_date)){
            $array=[
                $target_date,
            ];
            // ストアドプロシージャ呼び出し
            DB::statement('CALL AUTO_RESERVATION(?,@msg)',$array);
            $result1 = DB::select('SELECT @msg AS result');
            $this->message = $this->datetime->format('Y-m-d H:i:s') .' ' . $result1[0]->result .  config('maintenance.user_eol');
        } else {
            $this->message = $this->datetime->format('Y-m-d H:i:s') .' ' . '日付形式に誤りがあります['.$target_date.']' .  config('maintenance.user_eol');
        }
        return $this->message;
    }

    /**
     * 日付の形式チェック
     * 
     * @param String
     * @return bool
     *  19xx,20xx年 かつ YYYY-MM-DD or YYYY/MM/DDがtrue
     */
    private function is_date($date){
        // スラッシュもハイフンに置換
        $check_date = \str_replace('/','-',$date);

        //19xx,20xx年が有効、ここは月と日の桁数だけを制御し、存在チェックは次のcheckdate関数で行う 
        if(!preg_match('/^(19|20)[0-9]{2}-\d{2}-\d{2}$/', $check_date)){
            return false;
        }
        // 分解
        list($y, $m, $d) = explode('-', $check_date);
    
        // 月・日・年
        if(!checkdate($m, $d, $y)){
            return false;
        }
        return true;
    }

}
