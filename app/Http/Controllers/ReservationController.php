<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Calendar\CalendarView;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel; 
use App\Exports\ReservationsExport; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;



class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view ('download');
    }

    /**
     * super管理者用ダウンロード画面
    */
    public function lists_for_super(Request $request)
    {
        return view ('super.reservation_lists');
    }


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
        DB::statement('CALL EDIT_RESERVATION(?,?,?,?,?,@msg)',$array);
        $result = DB::select('SELECT @msg AS result');
        $status = $result[0]->result; 
        return redirect('/user/reservation_list')->with('status', $status);

    }

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
