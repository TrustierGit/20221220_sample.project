<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notifications')->insert(
            [
            'domain_organization' =>'まるまる市',
            'text_message'=>'定期メンテナンスの為システム停止',
            'text_title'=>'Info',
            'flag_display'=>'0',
            'date_post'=>('20220926'),
           'created_at'=>('20220926'),
            ]);
        DB::table('notifications')->insert(
            [
            'domain_organization' =>'まるまる市',
            'text_title'=>'Info',
            'text_message'=>'定期メンテナンスの為システム停止',
            'flag_display'=>'1',
            'date_post'=>('20220816'),
            'created_at'=>('20220816'),
            ]);
            DB::table('notifications')->insert([
            'domain_organization' =>'まるまる市',
            'text_title'=>'Info',
            'text_message'=>'定期メンテナンスの為システム停止',
            'flag_display'=>'1',
            'date_post'=>('20220517'),
            'created_at'=>('20220517'),
            ]);
            DB::table('notifications')->insert(
                [
                'domain_organization' =>'まるまる市',
                'text_title'=>'Err',
                'text_message'=>'システムエラー発生。復旧済み',
                'flag_display'=>'0',
                'date_post'=>('20220918'),
               'created_at'=>('20220918'),
                ]);
            DB::table('notifications')->insert(
                [
                'domain_organization' =>'まるまる市',
                'text_title'=>'Err',
                'text_message'=>'システムエラー発生。復旧済み',
                'flag_display'=>'1',
                'date_post'=>('20220816'),
                'created_at'=>('20220816'),
                ]);
                DB::table('notifications')->insert([
                'domain_organization' =>'まるまる市',
                'text_title'=>'Err',
                'text_message'=>'システムエラー発生。復旧済み',
                'flag_display'=>'1',
                'date_post'=>('20220201'),
                'created_at'=>('20220201'),
                ]);
                DB::table('notifications')->insert(
                    [
                    'domain_organization' =>'まるまる市',
                    'text_title'=>'Info',
                    'text_message'=>'緊急メンテナンス',
                    'flag_display'=>'0',
                    'date_post'=>('20220909'),
                   'created_at'=>('20220909'),
                    ]);
                DB::table('notifications')->insert(
                    [
                    'domain_organization' =>'まるまる市',
                    'text_title'=>'Info',
                    'text_message'=>'緊急メンテナンス',
                    'flag_display'=>'1',
                    'date_post'=>('20220816'),
                    'created_at'=>('20220816'),
                    ]);
                    DB::table('notifications')->insert([
                    'domain_organization' =>'まるまる市',
                    'text_title'=>'Info',
                    'text_message'=>'緊急メンテナンス',
                    'flag_display'=>'1',
                    'date_post'=>('20220529'),
                    'created_at'=>('20220529'),
                    ]);
                    DB::table('notifications')->insert(
                        [
                        'domain_organization' =>'まるまる市',
                        'text_title'=>'Err',
                        'text_message'=>'緊急メンテナンス',
                        'flag_display'=>'0',
                        'date_post'=>('20211123'),
                       'created_at'=>('20211123'),
                        ]);
                    DB::table('notifications')->insert(
                        [
                        'domain_organization' =>'まるまる市',
                        'text_title'=>'Err',
                        'text_message'=>'緊急メンテナンス',
                        'flag_display'=>'1',
                        'date_post'=>('20210809'),
                        'created_at'=>('20210809'),
                        ]);
                        DB::table('notifications')->insert([
                        'domain_organization' =>'まるまる市',
                        'text_title'=>'Err',
                        'text_message'=>'緊急メンテナンス',
                        'flag_display'=>'1',
                        'date_post'=>('20210517'),
                        'created_at'=>('20210517'),
                        ]);


                        

                        
        DB::table('notifications')->insert(
            [
            'domain_organization' =>'さんかく市',
            'text_message'=>'定期メンテナンスの為システム停止',
            'text_title'=>'Info',
            'flag_display'=>'0',
            'date_post'=>('20220926'),
           'created_at'=>('20220926'),
            ]);
        DB::table('notifications')->insert(
            [
            'domain_organization' =>'さんかく市',
            'text_title'=>'Info',
            'text_message'=>'定期メンテナンスの為システム停止',
            'flag_display'=>'1',
            'date_post'=>('20220816'),
            'created_at'=>('20220816'),
            ]);
            DB::table('notifications')->insert([
            'domain_organization' =>'さんかく市',
            'text_title'=>'Info',
            'text_message'=>'定期メンテナンスの為システム停止',
            'flag_display'=>'1',
            'date_post'=>('20220517'),
            'created_at'=>('20220517'),
            ]);
            DB::table('notifications')->insert(
                [
                'domain_organization' =>'さんかく市',
                'text_title'=>'Err',
                'text_message'=>'システムエラー発生。復旧済み',
                'flag_display'=>'0',
                'date_post'=>('20220918'),
               'created_at'=>('20220918'),
                ]);
            DB::table('notifications')->insert(
                [
                'domain_organization' =>'さんかく市',
                'text_title'=>'Err',
                'text_message'=>'システムエラー発生。復旧済み',
                'flag_display'=>'1',
                'date_post'=>('20220816'),
                'created_at'=>('20220816'),
                ]);
                DB::table('notifications')->insert([
                'domain_organization' =>'さんかく市',
                'text_title'=>'Err',
                'text_message'=>'システムエラー発生。復旧済み',
                'flag_display'=>'1',
                'date_post'=>('20220201'),
                'created_at'=>('20220201'),
                ]);
                DB::table('notifications')->insert(
                    [
                    'domain_organization' =>'さんかく市',
                    'text_title'=>'Info',
                    'text_message'=>'緊急メンテナンス',
                    'flag_display'=>'0',
                    'date_post'=>('20220909'),
                   'created_at'=>('20220909'),
                    ]);
                DB::table('notifications')->insert(
                    [
                    'domain_organization' =>'さんかく市',
                    'text_title'=>'Info',
                    'text_message'=>'緊急メンテナンス',
                    'flag_display'=>'1',
                    'date_post'=>('20220816'),
                    'created_at'=>('20220816'),
                    ]);
                    DB::table('notifications')->insert([
                    'domain_organization' =>'さんかく市',
                    'text_title'=>'Info',
                    'text_message'=>'緊急メンテナンス',
                    'flag_display'=>'1',
                    'date_post'=>('20220529'),
                    'created_at'=>('20220529'),
                    ]);
                    DB::table('notifications')->insert(
                        [
                        'domain_organization' =>'さんかく市',
                        'text_title'=>'Err',
                        'text_message'=>'緊急メンテナンス',
                        'flag_display'=>'0',
                        'date_post'=>('20211123'),
                       'created_at'=>('20211123'),
                        ]);
                    DB::table('notifications')->insert(
                        [
                        'domain_organization' =>'さんかく市',
                        'text_title'=>'Err',
                        'text_message'=>'緊急メンテナンス',
                        'flag_display'=>'1',
                        'date_post'=>('20210809'),
                        'created_at'=>('20210809'),
                        ]);
                        DB::table('notifications')->insert([
                        'domain_organization' =>'さんかく市',
                        'text_title'=>'Err',
                        'text_message'=>'緊急メンテナンス',
                        'flag_display'=>'1',
                        'date_post'=>('20210517'),
                        'created_at'=>('20210517'),
                        ]);



                        
        DB::table('notifications')->insert(
            [
            'domain_organization' =>'しかく市',
            'text_message'=>'定期メンテナンスの為システム停止',
            'text_title'=>'Info',
            'flag_display'=>'0',
            'date_post'=>('20220926'),
           'created_at'=>('20220926'),
            ]);
        DB::table('notifications')->insert(
            [
            'domain_organization' =>'しかく市',
            'text_title'=>'Info',
            'text_message'=>'定期メンテナンスの為システム停止',
            'flag_display'=>'1',
            'date_post'=>('20220816'),
            'created_at'=>('20220816'),
            ]);
            DB::table('notifications')->insert([
            'domain_organization' =>'しかく市',
            'text_title'=>'Info',
            'text_message'=>'定期メンテナンスの為システム停止',
            'flag_display'=>'1',
            'date_post'=>('20220517'),
            'created_at'=>('20220517'),
            ]);
            DB::table('notifications')->insert(
                [
                'domain_organization' =>'しかく市',
                'text_title'=>'Err',
                'text_message'=>'システムエラー発生。復旧済み',
                'flag_display'=>'0',
                'date_post'=>('20220918'),
               'created_at'=>('20220918'),
                ]);
            DB::table('notifications')->insert(
                [
                'domain_organization' =>'しかく市',
                'text_title'=>'Err',
                'text_message'=>'システムエラー発生。復旧済み',
                'flag_display'=>'1',
                'date_post'=>('20220816'),
                'created_at'=>('20220816'),
                ]);
                DB::table('notifications')->insert([
                'domain_organization' =>'しかく市',
                'text_title'=>'Err',
                'text_message'=>'システムエラー発生。復旧済み',
                'flag_display'=>'1',
                'date_post'=>('20220201'),
                'created_at'=>('20220201'),
                ]);
                DB::table('notifications')->insert(
                    [
                    'domain_organization' =>'しかく市',
                    'text_title'=>'Info',
                    'text_message'=>'緊急メンテナンス',
                    'flag_display'=>'0',
                    'date_post'=>('20220909'),
                   'created_at'=>('20220909'),
                    ]);
                DB::table('notifications')->insert(
                    [
                    'domain_organization' =>'しかく市',
                    'text_title'=>'Info',
                    'text_message'=>'緊急メンテナンス',
                    'flag_display'=>'1',
                    'date_post'=>('20220816'),
                    'created_at'=>('20220816'),
                    ]);
                    DB::table('notifications')->insert([
                    'domain_organization' =>'しかく市',
                    'text_title'=>'Info',
                    'text_message'=>'緊急メンテナンス',
                    'flag_display'=>'1',
                    'date_post'=>('20220529'),
                    'created_at'=>('20220529'),
                    ]);
                    DB::table('notifications')->insert(
                        [
                        'domain_organization' =>'しかく市',
                        'text_title'=>'Err',
                        'text_message'=>'緊急メンテナンス',
                        'flag_display'=>'0',
                        'date_post'=>('20211123'),
                       'created_at'=>('20211123'),
                        ]);
                    DB::table('notifications')->insert(
                        [
                        'domain_organization' =>'しかく市',
                        'text_title'=>'Err',
                        'text_message'=>'緊急メンテナンス',
                        'flag_display'=>'1',
                        'date_post'=>('20210809'),
                        'created_at'=>('20210809'),
                        ]);
                        DB::table('notifications')->insert([
                        'domain_organization' =>'しかく市',
                        'text_title'=>'Err',
                        'text_message'=>'緊急メンテナンス',
                        'flag_display'=>'1',
                        'date_post'=>('20210517'),
                        'created_at'=>('20210517'),
                        ]);



                    }
                }

