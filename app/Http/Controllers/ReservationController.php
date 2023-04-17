<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\AuthHistory;
use Illuminate\Http\Request;
use App\Calendar\CalendarView;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel; 
use App\Exports\ReservationsExport;
use App\Exports\ReservationsExport_for_super;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use App\Models\Log;
use App\Models\Organization;



class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::User()->mode_admin =='1'){
            $organizations = DB::table('organizations')->where('domain_organization','=',Auth::User()->domain_organization)->get();
        }elseif(Auth::User()->mode_admin =='9'){
            $organizations = DB::table('organizations')->get();
        }
        return view ('download',compact('organizations'));
    }

    /**
     * super管理者用ダウンロード画面
    */
    // public function lists_for_super(Request $request)
    // {
    //     return view ('super.reservation_lists');
    // }


    /**
     * Display the specified resource.
     *
     * 注意：method CarbonInterface  addMonthsNoOverflow(int $value = 1) 
     * 
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */

    public function show(Request $request,Reservation $reservation)
    {
        $now =new Carbon();
        $time =$now->format('H:i');
        $char_digit=-5;
        $target_view='';
        $param_arr=[];
       
            $this_month = Carbon::now()->format('Y-m');
            $next_month = Carbon::now()->addMonthsNoOverflow(config('cal.next_month'))->format('Y-m');
            $calendar = new CalendarView($this_month);
            $next_calendar = new CalendarView($next_month);
            $user_email= Auth::user()->email;
    
            $target_view='reservation.index';
            $param_arr=['calendar'=>$calendar,'next_calendar'=>$next_calendar];
        
        return view($target_view,$param_arr);


    }

    /**
     * reservation履歴export
     * 
     */
    public function export(Request $request){

       $exports = new ReservationsExport($request);
       $exists = $exports->collection()->count();

       if($exists > 0){
	        return Excel::download($exports, 'reservation_list.csv'); 
        }else{
            return redirect('/admin/download')->with('status','該当データはありません');
        }
    
    }

    /**
     * download一覧
     */

    public function download_link(Request $request)
    {
        return view ('download_link');
    }


    /**
     * 予約function用
     */
    
    public $array;

    
    function __construct(){
		
        $this->array ='';
       
    }
    
    /**
     * ストアドプロシージャから予約の登録($button=0)／取消($button=1)を行う
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response + $status ストアドプロシージャからのメッセージ
     */
    public function switch(Request $request){
        $rsvdate = $request->input('rsvdate');
        $user_email = $request->input('email');
        $user_organaization = Auth::user()->domain_organization;
        $user_mode =Auth::user()->mode_reserve;
        $now = Carbon::now();
        
        $request->validate(['rsvdate' =>'after:now'],
                            ['rsvdate.after'=>'過去日は予約できません']);
        // 登録／取消の判定
        $button = ($request->has('make_reservation'))? 1 : 0;

        $array=[
            $button,
            $user_organaization,
            $user_mode,
            $rsvdate,
            $user_email,
            ];

        /*
            ストアドプロシージャ呼び出し
            注意：@msgはストアドプロシージャ内でのOUTPUT（戻り値）を格納する変数
                  戻り値を取得するために再度DB::selectで取得
        */ 
        $user_id = Auth::user()->id;
        $log_head = $this->loginfo('start',$array,'ストアドプロシージャ呼び出し');
        $login_time_id = DB::table('logs')
                        ->where('user_id' ,'=',$user_id)
                        ->max('id');
        $this->logmake($log_head,$login_time_id);

        //プロシージャ呼び出し
        try{  
            DB::statement('CALL EDIT_RESERVATION(?,?,?,?,?,@msg)',$array);
            $result = DB::select('SELECT @msg AS result');
            $status = $result[0]->result; 
        }catch (\Exception $e) {
            //プロシージャ呼び出しで失敗時ログ
            $message = $e->getMessage();
            $substr_message = [substr($message,0,4000)]; 
            $this->logmake($substr_message,$login_time_id);
        }
        // 終了ログ
        $log_head = $this->loginfo('end',$array,$status);

        $this->logmake($log_head,$login_time_id);

        return redirect('/user/reservation_list')->with('status', $status);

    }

    /**
     * logのinfoカラム定義
     */
    public function loginfo($info,$array,$status=''){
        $log_info=[
            'function' =>'register'
            ,'StoredName'=>'CALL EDIT_RESERVATION'
            ,'info'=>$info
            ,'Param'=>$array
            ,'msg'=>$status
        ];
        return $log_info;
    }
    /**
     * log生成
     */
    public function logmake($log_head,$login_time_id){
       
        Log::create(
            [
            'user_id' => Auth::user()->id,
            'email' =>AUth::user()->email,
            'ip_address' => request()->ip(),
            'info' => json_encode($log_head),
            'user_agent' => request()->userAgent(),
            'login_time' => Log::find($login_time_id)->login_time
            ]
        );
    }
    /**
     * 
     * @param $request
     * 
     */
    
        /**
     * 予約登録画面のAjaxから呼び出される処理
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response + $result_arr JSON形式
     */
    public function ajax(Request $request){
            $rsvdate = $request->input('days');
            $user_email = Auth::user()->email;
            $user_organaization = Auth::user()->domain_organization;

            $is_reserved =  DB::table('reservations')
                                ->where('domain_organization' ,'=',$user_organaization)
                                ->where('date_reservation' ,'=',$rsvdate)
                                ->where('email_staff' ,'=',$user_email)
                                ->get()->count();
            $counts = DB::table('reservations')
                                ->where('domain_organization' ,'=',$user_organaization)
                                ->whereDate('date_reservation' ,'=',$rsvdate)
                                ->get()->count();
            
            $result_arr[] = [
                "email"=>$user_email ,
                "days"=>$rsvdate,
                "is_reserved"=>$is_reserved,
                "counts"=>$counts,
            ];

        return json_encode($result_arr);
    }
}
