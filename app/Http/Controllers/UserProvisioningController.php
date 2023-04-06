<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserProvisioningController extends Controller
{
    public function UserProvisioning(){

        $this->message='トランザクションスタート...';
        return $this->message;
        DB::transaction(function () {
            // DB::Organization
            // ★★★20230406追加予定★★★
        });
        

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
