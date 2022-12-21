<?php
namespace App\Calendar;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Holiday;
/**
 * 予約登録画面作成クラス
 */

class CalendarView {

	private $carbon;
	private $holiday_list;
	private $time;
    private $char_digit;
    public $flag_open;
	private $date_maintenance;

	function getLicenseCount(){
				//上限数確認
				$user_organaization= Auth::user()->domain_organization;
				$mode_reserve = Auth::user()->mode_reserve;
				$count_license_arr = DB::table('organizations')->where('domain_organization' ,'=',$user_organaization)->where('mode_reserve' ,'=',$mode_reserve)->get('count_license');
				return	$count_license_arr[0]->count_license;
	}

	function getOpenHour(){
		//営業時間確認(時間内:true 時間外:false)
		$this->time =Carbon::now()->format('H:i');
        $this->char_digit = -5;
		$this->flag_open = 
		(
		 $this->time >= substr('0' . config('maintenance.open_from'),$this->char_digit) &&
		 $this->time <= substr('0' . config('maintenance.open_to'),$this->char_digit)
		 ?  true : false );	
}

	function getDate_Maintenance(){
		$this->date_maintenance = Auth::user()->organization->date_maintenance;
	}

	function __construct($date){
		$this->carbon = new Carbon($date);
		$this->holiday_list=$this->getHoliday();
		$this->getOpenHour();
		$this->getDate_Maintenance();

	}

	/**
	 * タイトル
	 * 
	 * @param int $month=0(default)
	 * 
	 */
	public function getTitle(int $month = 0){
		return $this->carbon->copy()->addMonthsNoOverflow($month)->format('Y年n月');
	}

	//今月の祝日取得
	function getHoliday(){
		$result_arr=[];
		// $result=[];
		$start_of_month = $this->carbon->startOfMonth()->format('Y-m-d');
		$end_of_month = $this->carbon->endOfMonth()->format('Y-m-d');
		$result= DB::table('holidays')->whereBetween('date_holiday' ,[$start_of_month,$end_of_month])->get("date_holiday")->toArray();

		foreach ($result as $key => $value) {
			$result_arr[]=$value->date_holiday;
		}
		// return $result;
		return $result_arr;
	}

	

	/**
	 * カレンダーを出力する
	 */
	function render($addmonth){
		$html = [];

		$html[] = '<div class="calendar">';
		$html[] = '<table class="table text-center whitespace-no-wrap  border-solid border-collapse">';
		$html[] = '<thead>';
		$html[] = '<tr>';

		$html[] = '<th class="text-red-600">日</th>';
		$html[] = '<th class="text-black">月</th>';
		$html[] = '<th class="text-black">火</th>';
		$html[] = '<th class="text-black">水</th>';
		$html[] = '<th class="text-black">木</th>';
		$html[] = '<th class="text-black">金</th>';
		$html[] = '<th class="text-indigo-900">土</th>';

		$html[] = '</tr>';
		$html[] = '</thead>';

		$html[] = '<tbody>';
		
		$weeks = $this->getWeeks();
		$weekCounter=0;
		$user_email= Auth::user()->email;
		$rev_array = DB::table('reservations')->where('email_staff' ,'=',$user_email)->get(['date_reservation'])->toArray();
		$reservation_array = [];

		//上限数確認
		$user_organaization= Auth::user()->domain_organization;
		$count_license=$this->getLicenseCount();

		foreach ($rev_array as $key => $value) {
			$reservation_array[]=$value->date_reservation;
		}


		foreach($weeks as $week){
			$weekCounter++;
			$html[] = '<tr class="'.$week->getClassName().'">';
 			$days = $week->getDays();
			foreach($days as $day){
				// 予約済みの日付は配色を変更する
				//配色の順番注意
				$class_add ='';

				//祝日
				$class_add = (in_array($day->getDay(),$this->holiday_list)) ? 'holiday' : '' ;

				//赤
				$is_reserved = DB::table('reservations')->where('domain_organization' ,'=',$user_organaization)->where('date_reservation', $day->getDay())->count();
				$class_add = ($is_reserved >= $count_license &&  $day->getClassName() !== "day-blank") ? 'is_reserved': $class_add ;

				//緑
				$class_add = (in_array($day->getDay(),$reservation_array) &&  $day->getClassName() !== "day-blank" ) ? 'reserved_ticket' : $class_add ;
				
				//灰色
				$today=Carbon::now();
				$class_add = ($today > $day->getDay()) || $this->date_maintenance <= $day->getDay() ?'pastday' : $class_add ;
				

				$html[] = '<td class="'.$day->getClassName().' '. $class_add .'">';
				
				if($class_add !== 'pastday' && $this->flag_open === true){
						$html[] = '<div class="date-button text-3xl font-bold">
						<button class="button-calender" type="button" @click="open = true" data-toggle="modal" data-target="#registerModal" data-value="'. $day->getDay() .'"  id="calender_date'. $day->getDay() .'"> '
						. $day->render() .' </button></div>';
				}else{
					// $html[] = '<div text-3xl font-bold>'. $day->render() .'</div>';
					$html[] = '<div class="date-button text-3xl font-bold">
					<button type="button" @click="open = false" disabled 
					data-value="'. $day->getDay() .'"  id="calender_date'. $day->getDay() .'"> '
					. $day->render() .' </button></div>';
				}

				$html[] = '</td>';

			}
			$html[] = '</tr>';
		}
	// $weekオブジェクトの個数が6週未満の場合、6週表示にするため補てんする
		for($i=$weekCounter;$i<config('cal.week_count');$i++){
			$html[] = '<tr class="dummy"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>';
		}

		$html[] = '</tbody>';

		$html[] = '</table>';
		$html[] = '</div>';


		return implode("", $html);
	}

	protected function getWeeks(){
		$weeks = [];

		//初日
		$firstDay = $this->carbon->copy()->firstOfMonth();

		//月末まで
		$lastDay = $this->carbon->copy()->lastOfMonth();

		//1週目
		$week = new CalendarWeek($firstDay->copy());
		$weeks[] = $week;

		//作業用の日
		$tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();
		
		//月末までループさせる
		while($tmpDay->lte($lastDay)){
			//週カレンダーViewを作成する
			$week = new CalendarWeek($tmpDay, count($weeks));
			$weeks[] = $week;
			
            //次の週=+7日する
			$tmpDay->addDay(7);
		}

		return $weeks;		
		
	}
	
 
}


	


