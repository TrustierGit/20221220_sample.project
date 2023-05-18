<?php

namespace App\Exports;

use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Http\Controllers\ReservationController;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

/**
 * csvエクスポートクラス
 */
class ReservationsExport implements FromCollection,WithHeadings, WithStrictNullComparison,WithMapping
{
    public $request_con;
    
    public function __construct(Request $request){
        $this->request_con = $request;
    }

    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        
        $reservation_date=$this->request_con->ymd;
        //置き換え
        $start = substr($reservation_date,0,7) .'-01';
        // $start = $reservation_date ;
        $end = $reservation_date ;
        // ★スクロール選択
        // $user_organaization = Auth::user()->domain_organization;
        $user_organaization =$this->request_con->domain_organization;
        return Reservation::where('domain_organization',$user_organaization)
        // return Reservation::
        ->Where('date_reservation','>=',$start)
	        ->Where('date_reservation','<=',$end)
            //★id,'text_remarks'がいらない
            // ドメイン・日付（予約日）・メアドでソート
            ->select(['domain_organization','mode_reserve','date_reservation','email_staff','updated_at'])
            ->orderByRaw('domain_organization asc, date_reservation asc, email_staff asc')
            ->get();

    
// $employeeData = $employee
//                 ->select(['id', 'name', 'department'])
//                 ->get();

    }


    public function map($row) :array
        {
            return [
                $row->domain_organization,
                $row->mode_reserve,
                $row->date_reservation,
                $row->email_staff,
                //timestampからdatetimeに変換
                Carbon::parse($row->updated_at)->__toString(),
            ];
        }
    

    public function headings():array
	{
		return [
                '自治体ドメイン名',
                'アカウントフラグ（0:通常/1:常時）',
				'予約日', 
                '職員メールアドレス',  
                'データ更新日'
                 
			]; 

    }

    
    
}
