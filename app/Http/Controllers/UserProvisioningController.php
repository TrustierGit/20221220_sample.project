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



class UserProvisioningController extends Controller
{

    private $message;
    private $upload_date;

    public function __construct(){
        $this->message = '';
        $this->upload_date=  Carbon::now()->format('YmdHis');
    }

    public function UserProvisioning(){


        $this->message='トランザクションスタート....'.config('maintenance.user_eol');
        // DB::transaction(function (Request $request) {
            //     １．自治体絞り込み　★管理コンソール側から自治体指定
            //     ２．UPD 一回全部論理削除（一般ユーザ）
            try{
                $this->message .= '全ユーザー論理削除中....'.config('maintenance.user_eol');
              $provisioning_users = DB::table('users')
            //   ★自治体指定方法を変更要
                    ->where('domain_organization', '=', 'marumaru.co.jp')
                    ->where('mode_admin', '=','0')
                    ->update(['flag_delete' => 1]);
                $this->message .= 'ファイル読み込み中....'.config('maintenance.user_eol');
            //     ３．アップロードしたファイル読み込み★アップロードfunction作成
            //     　３－１．UPD ユーザデータアップデート（上書き）
                

            //     　　３－１で0件（データなしなら）３－２へ
            //     　３－２．INS 0件ならif文の中でインサート
            //     ４．DEL 論理削除を一括デリート
            // トランザクションエンド
        // });

        // return $this->message;
                dd($this->message);
            }catch (\Exception $e) {
                $this->message .= '失敗しました' .config('maintenance.user_eol').$e->getMessage();
                dd($this->message);
            }

    }
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
                    // if($rq->hasFile('csv') && $rq->file('csv')->isValid()) {
                    if($rq->file('csv')->getClientOriginalExtension() == "csv") {
                        // CSV ファイル保存
                        
                        $tmpname = "CSVUP_".$this->upload_date.".".$rq->file('csv')->guessExtension(); //TMPファイル名
                        $rq->file('csv')->move(public_path()."/csv/tmp",$tmpname);
                        // ■tmppath使う？
                        $tmppath = public_path()."/csv/tmp/".$tmpname;

                        // ファイル内容取得
                        $csv = file($tmppath);
                        // 改行コードを統一
                        // $csv = str_replace(array("\r\n","\r"), "\n", $csv);
                        // // 行単位のコレクション作成
                        // $data = collect(explode("\n", $csv));
                        dd($csv);

                        //★★return

                    //     $comment = "取り込み成功";
                    //     $subject = "status";
                    // }else{
                    //     $comment = "取り込みエラー：ファイル形式を確認してください。";
                    //     $subject = "error";
                        
                    
                    //     // Goodby CSVの設定
                    //     $config_in = new LexerConfig();
                    //     $config_in
                    //         ->setFromCharset("SJIS-win")
                    //         ->setToCharset("UTF-8") // CharasetをUTF-8に変換
                    //         ->setIgnoreHeaderLine(true) //CSVのヘッダーを無視
                    //     ;
                    //     $lexer_in = new Lexer($config_in);

                    //     $datalist = array();

                    //     $interpreter = new Interpreter();
                    //     $interpreter->addObserver(function (array $row) use (&$datalist){
                    //     // 各列のデータを取得
                    //     $datalist[] = $row;
                    //     });

                    //     // CSVデータをパース
                    //     $lexer_in->parse($tmppath,$interpreter);

                    //     // TMPファイル削除
                    //     unlink($tmppath);

                    //     // 処理
                    //     foreach($datalist as $row){
                    //         // 各データ取り出し
                    //         $csv_user = $this->get_csv_user($row);
                    //         // DBへの登録
                    //         // dd($csv_user);
                    //         $this->updateOrCreate($csv_user);

                    //     }
                    //     // return redirect('/superuser/UserProvisioning')->with('flashmessage','CSVのデータを読み込みました。');
                    //     return redirect('/superuser/UserProvisioning');
                    }
                    // ★
                    // return redirect('/superuser/UserProvisioning')->with($subject, $comment);
                    return redirect('/superuser/UserProvisioning');
                }


                private function get_csv_user($row)
                {
                    $users= array(
                        'email' => $row[0],
                        'domain_organization' => $row[1],
                        'mode_reserve' => $row[2],
                        'name' => $row[3],
                        'password' => Hash($row[4]),
                        'mode_admin' => $row[5],
                        'flag_delete' => $row[6],
                        'email_verified_at' => $row[7]

                    );
                    return $users;
                }

                private function updateOrCreate($users, $email = null)
                {  
                    User::updateOrCreate(['email' => $email],$users);

                }

            }


