<?php

namespace App\Exports;

use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Http\Controllers\ReservationController;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/**
 * csvエクスポートクラス
 */
class ReservationsExport implements FromCollection,WithHeadings
{
    protected $request_con;

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
        $user_organaization = Auth::user()->domain_organization;

        return Reservation::where('domain_organization',$user_organaization)
        ->Where('date_reservation','>=',$start)
        ->Where('date_reservation','<=',$end)
        ->get();

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
				'データ登録日', 
				'データ更新日'
			]; 

	}

    public function bindValue(Cell $cell, $value)
    {
        // 全てを文字列型で返す
        $cell->setValueExplicit($value, DataType::TYPE_STRING);
        return true;
    }
}
