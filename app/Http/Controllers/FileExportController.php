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
/**
 * バッチ処理に時間がかかる場合を想定
 * OPEN_FROM（営業開始時間）から-7時間ずらし、23:59に翌日分のリストを取得
 */
public function __construct(){

    $this->user_eol = config('maintenance.user_eol');
    
    $this->date=  Carbon::now()->addHours(17)->format('Y-m-d');
    $this->today= Carbon::now()->addHours(17)->format('Ymd');
    $this->thisMonth =Carbon::now()->addHours(17)->format('Ym');

    
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
                return $message; 
            }

            $message=  $this->sendCSV();
        return $message; 


        }


     private function makeCSV($filename,$dataArr){
        try{
            $data = count($dataArr);
            foreach($dataArr as $key =>$value){
                $data .= $this->user_eol . $value['email_staff'];
            }
            $folder_name=$this->thisMonth;
            $folder_name_day = $this->today;
            $this->file_path='./csv_export/'.$folder_name.'/'.$folder_name_day.'/';

            $output_csv= $this->file_path . $this->today .'_' . $filename . '.csv';
            // Storage::put($this->file_path . $this->today .'_' . $filename . '.csv', $data);
            Storage::put($output_csv, $data);

            // Storage::disk('ftp')->put($this->file_path . $this->today .'_' . $filename . '.csv', $this->file_path . $this->today .'_' . $filename . '.csv');
        } catch(\Exception $e){
            throw new UserException('makeCSV error');
        }
     }

     private function sendCSV(){
        $message='';
        try{
            $folder_name=$this->thisMonth;
            $folder_name_day = $this->today;
            $this->file_path='./csv_export/'.$folder_name.'/'.$folder_name_day.'/';
            $files_arry = Storage::allFiles($this->file_path);
            foreach($files_arry as $file){
                Storage::disk('ftp')->put($file,$file);
            }
            $message = '完了';
            return $message;
        } catch(\Exception $e){
            $message = $e->getMessage();
            return $message;
        }
        return $message; 

    }
    
}
