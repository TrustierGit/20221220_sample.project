<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Goodby\CSV\Import\Standard\LexerConfig;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


// ★参考
// https://laraweb.net/tutorial/5906/
// https://beyondjapan.com/blog/2020/10/goodbycsv/

class UserProvisioningController extends Controller
{

    // public $message;
    private $upload_date;

    public function __construct(){
        // $this->message = '';
        $this->upload_date=  Carbon::now()->format('YmdHis');
    }

    const CSV_HEADER = [
        'email',
        'domain_organization',
        'mode_reserve',
        'name',
        'password',
        'mode_admin',
        'flag_delete',
        'email_verified_at',
    ];

   
            public function csv_uploader()
            {
                $organizations = DB::table('organizations')
                                    ->where('mode_reserve','=','0')
                                    ->where('flag_delete','=','0')
                                    ->orderByRaw('name_organization asc')->get();
                return view ('super.csv_uploader',compact('organizations'));
                
            }

                public function upload_regist(Request $rq)
                {
                    //管理コンソール上に出力するメッセージ
                    $message ="";
                    // 管理コンソール上での指定
                    $select_organization = $rq->domain_organization;
                    $mode_admin = $rq->mode_admin;

                            if($rq->file('csv')->getClientOriginalExtension() == "csv") {

                                        // CSV ファイル保存
                                        $tmpname = "CSVUP_".$this->upload_date.".".$rq->file('csv')->guessExtension(); //TMPファイル名
                                        $rq->file('csv')->move(public_path()."/csv/tmp",$tmpname);
                                        $tmppath = public_path()."/csv/tmp/".$tmpname;
                                        list($csvArray,$count) = $this->MakeArray($tmppath);
                                            foreach ($csvArray as $key => $value) {
                                                if(!($value['domain_organization'] == $select_organization && $value['mode_admin'] == $mode_admin)){
                                                    $message .= "ファイルの保存に失敗しました。　記載内容を確認してください。";
                                                    return redirect('/superuser/UserProvisioning')->with('error',$message);
                                                }
                                            }                                       
                                            // Goodby CSVの設定
                                            $datalist = $this->goodby($tmppath);
                                                                 //DBへupsert
                                                                 try{
                                                                    // 処理
                                                                    DB::transaction(function(){

                                                                    });
                                                                    $this->softDelete($select_organization,$mode_admin);
                                                                    $count ='0';
                                                                    foreach($datalist as $row){
                                                                        // 各データ取り出し
                                                                        $csv_user = $this->get_csv_user($row);
                                                                        // 1行ずつDBへの登録
                                                                            User::upsert($csv_user,['email']);
                                                                    $count++;
                                                                    }    
                                                                    //     ４．DEL 論理削除を一括デリート                                   
                                                                    $delete_count = $this->delete($select_organization,$mode_admin);
                                                                    $subject = "status";
                                                                    $message .= $count."件取り込み、".$delete_count."件削除しました";
                                                                }catch (\Exception $e) {
                                                                    $message .= '登録に失敗しました' ;
                                                                    $subject ="error";
                                                                }                                                     
                                                    
                                            // TMPファイル削除
                                            unlink($tmppath);  
                                            return redirect('/superuser/UserProvisioning')->with($subject,$message);
                        
                                            // トランザクションエンド
                            }else{
                                $message .= "ファイルの保存に失敗しました。　拡張子を確認してください。";
                                return redirect('/superuser/UserProvisioning')->with('error',$message);
                            }
                }

                public function get_csv_user($row)
                {
                    $user = array(
                        'email'=> $row[0],
                        'domain_organization'=> $row[1],
                        'mode_reserve'=> $row[2],
                        'name'=> trim($row[3]),
                        'password'=> Hash::make(trim($row[4])),
                        'mode_admin'=> $row[5],
                        'flag_delete'=> $row[6],
                    );
                    return $user;
                }

                public function softDelete($select_organization,$mode_admin){
                    try{
                      DB::table('users')
                            ->where('domain_organization', '=', $select_organization)
                            ->where('mode_admin', '=', $mode_admin)
                            ->update(['flag_delete' => 1]);
                    }catch (\Exception $e) {
                    }
                }


                public function goodby($tmppath){
                    $config_in = new LexerConfig();
                    $config_in
                        ->setFromCharset("UTF-8")//SJISだと日本語読み込み時に文字化け
                        ->setToCharset("UTF-8") // CharasetをUTF-8に変換
                        ->setIgnoreHeaderLine(true) //CSVのヘッダーを無視
                    ;
                    $lexer_in = new Lexer($config_in);

                    $datalist = array();

                    $interpreter = new Interpreter();
                    //エラー対策
                    $interpreter->unstrict();
                    $interpreter->addObserver(function (array $row) use (&$datalist){
                    // 各列のデータを取得
                    $datalist[] = $row;
                    });

                    // CSVデータをパース
                    $lexer_in->parse($tmppath,$interpreter);
                    return $datalist;
                }

                public function delete($select_organization,$mode_admin){
                      $delete_count = DB::table('users')
                                        ->where('domain_organization', '=', $select_organization)
                                        ->where('mode_admin', '=',$mode_admin)
                                        ->where('flag_delete', '=','1')
                                        ->delete();
                                                        
                      return $delete_count;
                }

                public function MakeArray($tmppath){
                        $csvArray = array();
                        $firstFlg = true;
                        $keys = array();
                        $count = 0;
                        $file = fopen($tmppath, 'r');
                      
                        while ($line = fgetcsv($file)) {
                          if($firstFlg){
                            for($i = 0; $i < count($line); $i++){
                              array_push($keys,$line[$i]);
                            }
                            $firstFlg = false;
                          }else{
                            for($i = 0; $i < count($line); $i++){
                              $csvArray[$count][$keys[$i]] = $line[$i];
                            }
                            $count++;
                          }
                        }
                        fclose($file);
                        return [$csvArray,$count];
                      }
                


                
}

