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
class ReservationsExport_for_super implements FromCollection,WithHeadings, WithStrictNullComparison,WithMapping
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
        $start = $reservation_date .'-01';
        $end = $reservation_date . '-31';

        return Reservation::where('date_reservation','>=',$start)
            ->Where('date_reservation','<=',$end)
            ->select(['id','domain_organization','mode_reserve','date_reservation','email_staff','text_remarks','updated_at'])
            ->get();
    
        $employeeData = $employee
                ->select(['id', 'name', 'department'])
                ->get();

    }


    public function map($row) :array
        {
            return [
                $row->id,
                $row->domain_organization,
                $row->mode_reserve,
                $row->date_reservation,
                $row->email_staff,
                $row->text_remarks,
                //timestampからdatetimeに変換
                Carbon::parse($row->updated_at)->__toString(),
            ];
        }
    

    public function headings():array
	{
		return [
				'id',  
                '自治体ドメイン名',
                'アカウントフラグ（0:通常/1:常時）',
				'予約日', 
                '職員メールアドレス',
				'備考欄',  
                'データ更新日'
                 
			]; 

    }

    
    
}
