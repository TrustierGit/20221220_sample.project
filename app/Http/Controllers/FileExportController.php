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
    //出力日を決める
    $this->date=  Carbon::now()->addHours(17)->format('Y-m-d');
    $this->today= Carbon::now()->addHours(17)->format('Ymd');
    $this->thisMonth =Carbon::now()->addHours(17)->format('Ym');
    $this->file_path='./csv_export/'.$this->thisMonth.'/'.$this->today.'/';

}
    public function FileExport() {
        //Export前にフォルダを削除
        Storage::deleteDirectory($this->file_path);

        //サーバリスト取得（ファイル数）
        $serverlist = DB::table('organizations')
            ->where('flag_delete','=',0)
            ->select('stored_server')
            ->groupBy('stored_server')
            ->orderBy('stored_server','asc')
            ->get()->toArray();

        foreach ($serverlist as $key => $value) {
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
                //csv_exportフォルダの有無確認
                $exists= Storage::disk('local')->exists('csv_export');
                $count = 0;
                foreach ($this->outputlist as $key => $value) {
                    $this->makeCSV($key,$value); 
                    $count ++;
                }
                if ($exists){
                    //csv_exportフォルダがある場合
                    $message = $count.'files exported';
                }else{
                    //csv_exportフォルダが無い場合
                    $message = 'Made a new directory ,'.$count.' files exported';
                }      
            } catch (\Exception $e) {
                $message = $e->getMessage();
                return $message; 
            }
            $message=  $this->sendCSV() .$this->user_eol;
        return $message; 
        }

       
        /**
         * 該当フォルダに転送用ファイルを作成する
         */
     private function makeCSV($filename,$dataArr){
        try{
            $data = count($dataArr);
            foreach($dataArr as $key =>$value){
                $data .= $this->user_eol . $value['email_staff'];
            }
        //作成したファイルをlocalに保存
            Storage::put($this->file_path . $filename  . '_' . $this->today .'.csv', $data);

        } catch(\Exception $e){
            throw new UserException('makeCSV error');
        }
     }

    /**
     * 該当ディレクトリ内にあるファイルを全てFTP転送する
     */
     private function sendCSV(){
        $message='';
        $send_result='';
        try{
            //フォルダ内の全てのファイルを取得
            $files_arry = Storage::allFiles($this->file_path);
            //１件ずつFTP転送
            foreach($files_arry as $file){
                Storage::disk('ftp')->put(basename($file),Storage::get($file));
            //転送結果を表示
                $send_result .= date('Y-m-d H:i:s') . ' [' .  basename($file) . '] Send.' . $this->user_eol;
            }
            $message = $send_result .date('Y-m-d H:i:s') . ' ['  . count($files_arry) . '] files successfuly transferred ';
            return $message;
        } catch(\Exception $e){
            $message = $e->getMessage();
            return $message;
        }
        return $message; 

    }
    
}
