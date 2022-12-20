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
// use App\Exports\ReservationsExport;
use App\Exceptions\UserException;

/**
 * ファイル出力api
 */


class FileExportController extends Controller
{
    /**
     * @param
     * @return  
     */

    public $domainlist;
    public $outputlist;
    private $user_eol;
    private $file_path;
    private $date;
    private $today;
    private $message;
    private $thisMonth;

public function __construct(){

    $this->user_eol = config('maintenance.user_eol');
    
    $this->date=  Carbon::now()->format('Y-m-d');
    $this->today= Carbon::now()->format('Ymd');
    $this->thisMonth =Carbon::now()->format('Ym');
    
    // $this->file_path='./csv_export/';
    

}

    public function FileExport() {

        
        $serverlist = DB::table('organizations')
            ->where('flag_delete','=',0)
            ->select('stored_server')
            ->groupBy('stored_server')
            ->orderBy('stored_server','asc')
            ->get()->toArray();

        foreach ($serverlist as $key => $value) {


            $this->domainlist[$value->stored_server] = Organization::select('domain_organization')
                ->where('flag_delete','=',0)
                ->where('stored_server','=',$value->stored_server)
                ->get()->toArray();

 
            $this->outputlist[$value->stored_server] = Reservation::select('email_staff')
 
                ->whereIn(
                    'domain_organization',
                    Organization::select('domain_organization')
                        ->where('flag_delete','=',0)
                        ->where('stored_server','=',$value->stored_server)
                    )
                ->where('date_reservation','=',$this->date)   // ※日付の絞り込み
                ->orderBy('domain_organization','asc')
                ->orderBy('email_staff','asc')
                ->get()->toArray();

        }
        $message=''; 

            try{  
                $exists= Storage::disk('local')->exists('csv_export');
                $count = 0;
                foreach ($this->outputlist as $key => $value) {
                    $this->makeCSV($key,$value); 
                    $count ++;
                }
                // $exists=false;
                if ($exists){
                   
                    $message = $count.'files exported';
                }else{
                    $message = 'Made a new directory ,'.$count.' files exported';
    
                }
                     
            } catch (\Exception $e) {
                $message = $e->getMessage();
            }
        return $message; 

       
     }

     private function makeCSV($filename,$dataArr){
        // throw new UserException('makeCSV error');
        try{
            $data = count($dataArr);
            foreach($dataArr as $key =>$value){
                $data .= $this->user_eol . $value['email_staff'];
            }
            $folder_name=$this->thisMonth;
            $this->file_path='./csv_export/'.$folder_name.'/';

            Storage::put($this->file_path . $this->today .'_' . $filename . '.csv', $data);
        } catch(\Exception $e){
            throw new UserException('makeCSV error');
        }
 
     }
     
    
}
