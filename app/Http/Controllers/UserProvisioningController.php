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



class UserProvisioningController extends Controller
{

    private $message;

    public function __construct(){
        $this->message = '';
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
            public function csv_uploader(){
                return view ('super.csv_uploader');
            }

                public function upload_regist(Request $rq)
                {
                    if($rq->hasFile('csv') && $rq->file('csv')->isValid()) {
                    // CSV ファイル保存
                        $tmpname = uniqid("CSVUP_").".".$rq->file('csv')->guessExtension(); //TMPファイル名
                        $rq->file('csv')->move(public_path()."/csv/tmp",$tmpname);
                        $tmppath = public_path()."/csv/tmp/".$tmpname;

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
                        }
                    //     // return redirect('/superuser/UserProvisioning')->with('flashmessage','CSVのデータを読み込みました。');
                    //     return redirect('/superuser/UserProvisioning');
                    // }
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


