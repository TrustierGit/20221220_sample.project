<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserProvisioningController extends Controller
{

    private $message;

    public function __construct(){
        $this->message = '';
    }

    public function UserProvisioning(){


        $this->message='トランザクションスタート....'.config('maintenance.user_eol');
        DB::transaction(function (Request $request) {
              DB::table('users')
                    // ->where('domain_organization' = $request)
                    ->where('domain_organization' = 'marumaru.co.jp')
                    ->get();

            // ★★★作成したい流れ★★★
            // トランザクションスタート
                    １．自治体絞り込み
            //     ２．UPD 一回全部論理削除（一般ユーザ）
            //     ３．ファイル読み込み
            //     　３－１．UPD ユーザデータアップデート（上書き）
            //     　　３－１で0件（データなしなら）３－２へ
            //     　３－２．INS 0件ならif文の中でインサート
            //     ４．DEL 論理削除を一括デリート
            // トランザクションエンド
        });

        return $this->message;
        

    //     $userSplFileObject = new \SplFileObject(__DIR__ . '/data/users.csv');
    //     $userSplFileObject->setFlags(
    //         \SplFileObject::READ_CSV |
    //         \SplFileObject::READ_AHEAD |
    //         \SplFileObject::SKIP_EMPTY |
    //         \SplFileObject::DROP_NEW_LINE
    //     );

    //     $count = 0;
    //     foreach ($userSplFileObject as $key => $row) {
    //         if ($key === 0) {
    //             continue;
    //         }

    //         User::create([
    //             'email' => trim($row[0]),
    //             'domain_organization' => trim($row[1]),
    //             'mode_reserve' => trim($row[2]),
    //             'name' => trim($row[3]),
	// 	'password' => Hash::make(trim($row[4])),
	// 	'mode_admin' => trim($row[5]),
	// 	'flag_delete' => trim($row[6]),
    //         ]);
    //         $count++;
    //     }

    //     $this->command->info("メンバーを{$count}件、作成しました。");
    // }
    }
}
