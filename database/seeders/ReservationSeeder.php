<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Reservation;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservations')->insert(
            [
                'domain_organization' =>'まるまる市',
                'date_reservation'=>('20221001'),
                'email_staff'=>'test@test.com',
                'text_remarks'=>'テスト１',
                'created_at'=>('20220926'),
            ]);

            DB::table('reservations')->insert(
                [
                    'domain_organization' =>'まるまる市',
                    'date_reservation'=>('20221002'),
                    'email_staff'=>'test1@test.com',
                    'text_remarks'=>'テスト2',
                    'created_at'=>('20221001'),
                ]);

            DB::table('reservations')->insert(
            [
                'domain_organization' =>'まるまる市',
                'date_reservation'=>('20221101'),
                'email_staff'=>'test2@test.com',
                'text_remarks'=>'テスト3',
                'created_at'=>('20220927'),
            ]);

            DB::table('reservations')->insert(
                [
                    'domain_organization' =>'まるまる市',
                    'date_reservation'=>('20221001'),
                    'email_staff'=>'test4@test.com',
                    'text_remarks'=>'テスト4',
                    'created_at'=>('20221201'),
                ]);

                DB::table('reservations')->insert(
                    [
                        'domain_organization' =>'まるまる市',
                        'date_reservation'=>('20221001'),
                        'email_staff'=>'admin@admin.com',
                        'text_remarks'=>'テスト１',
                        'created_at'=>('20220926'),
                    ]);
        
                    DB::table('reservations')->insert(
                        [
                            'domain_organization' =>'まるまる市',
                            'date_reservation'=>('20221002'),
                            'email_staff'=>'admin@admin.com',
                            'text_remarks'=>'テスト2',
                            'created_at'=>('20221001'),
                        ]);
        
                    DB::table('reservations')->insert(
                    [
                        'domain_organization' =>'まるまる市',
                        'date_reservation'=>('20221101'),
                        'email_staff'=>'admin@admin.com',
                        'text_remarks'=>'テスト3',
                        'created_at'=>('20220927'),
                    ]);
        
                    DB::table('reservations')->insert(
                        [
                            'domain_organization' =>'まるまる市',
                            'date_reservation'=>('20220901'),
                            'email_staff'=>'admin@admin.com',
                            'text_remarks'=>'テスト4',
                            'created_at'=>('20221201'),
                        ]);

                        DB::table('reservations')->insert(
                            [
                                'domain_organization' =>'まるまる市',
                                'date_reservation'=>('20210101'),
                                'email_staff'=>'test@test.com',
                                'text_remarks'=>'テスト１',
                                'created_at'=>('20210626'),
                            ]);
                
                            DB::table('reservations')->insert(
                                [
                                    'domain_organization' =>'まるまる市',
                                    'date_reservation'=>('20210212'),
                                    'email_staff'=>'test1@test.com',
                                    'text_remarks'=>'テスト2',
                                    'created_at'=>('20210101'),
                                ]);
                
                            DB::table('reservations')->insert(
                            [
                                'domain_organization' =>'まるまる市',
                                'date_reservation'=>('20210301'),
                                'email_staff'=>'test2@test.com',
                                'text_remarks'=>'テスト3',
                                'created_at'=>('20210927'),
                            ]);
                
                            DB::table('reservations')->insert(
                                [
                                    'domain_organization' =>'まるまる市',
                                    'date_reservation'=>('20210401'),
                                    'email_staff'=>'test4@test.com',
                                    'text_remarks'=>'テスト4',
                                    'created_at'=>('20211201'),
                                ]);
                
                                DB::table('reservations')->insert(
                                    [
                                        'domain_organization' =>'まるまる市',
                                        'date_reservation'=>('20210506'),
                                        'email_staff'=>'admin@admin.com',
                                        'text_remarks'=>'テスト１',
                                        'created_at'=>('20210926'),
                                    ]);
                        
                                    DB::table('reservations')->insert(
                                        [
                                            'domain_organization' =>'まるまる市',
                                            'date_reservation'=>('20210607'),
                                            'email_staff'=>'admin@admin.com',
                                            'text_remarks'=>'テスト2',
                                            'created_at'=>('20211001'),
                                        ]);
                        
                                    DB::table('reservations')->insert(
                                    [
                                        'domain_organization' =>'まるまる市',
                                        'date_reservation'=>('20210708'),
                                        'email_staff'=>'admin@admin.com',
                                        'text_remarks'=>'テスト3',
                                        'created_at'=>('20210927'),
                                    ]);
                        
                                    DB::table('reservations')->insert(
                                        [
                                            'domain_organization' =>'まるまる市',
                                            'date_reservation'=>('20210901'),
                                            'email_staff'=>'admin@admin.com',
                                            'text_remarks'=>'テスト4',
                                            'created_at'=>('20211201'),
                                        ]);
                                        
                                         DB::table('reservations')->insert(
                                        [
                                            'domain_organization' =>'まるまる市',
                                            'date_reservation'=>('20210801'),
                                            'email_staff'=>'admin@admin.com',
                                            'text_remarks'=>'テスト4',
                                            'created_at'=>('20211201'),
                                        ]);
                                        
                                         DB::table('reservations')->insert(
                                        [
                                            'domain_organization' =>'まるまる市',
                                            'date_reservation'=>('20210201'),
                                            'email_staff'=>'admin@admin.com',
                                            'text_remarks'=>'テスト4',
                                            'created_at'=>('20210201'),
                                        ]);
                                         DB::table('reservations')->insert(
                                        [
                                            'domain_organization' =>'まるまる市',
                                            'date_reservation'=>('20211201'),
                                            'email_staff'=>'admin@admin.com',
                                            'text_remarks'=>'テスト4',
                                            'created_at'=>('20211201'),
                                        ]);
                                         DB::table('reservations')->insert(
                                        [
                                            'domain_organization' =>'まるまる市',
                                            'date_reservation'=>('20211201'),
                                            'email_staff'=>'admin@admin.com',
                                            'text_remarks'=>'テスト4',
                                            'created_at'=>('20211201'),
                                        ]);

                DB::table('reservations')->insert(
            [
                'domain_organization' =>'さんかく市',
                'date_reservation'=>('20221001'),
                'email_staff'=>'test@test.com',
                'text_remarks'=>'テスト１',
                'created_at'=>('20220926'),
            ]);

            DB::table('reservations')->insert(
                [
                    'domain_organization' =>'さんかく市',
                    'date_reservation'=>('20221002'),
                    'email_staff'=>'test1@test.com',
                    'text_remarks'=>'テスト2',
                    'created_at'=>('20221001'),
                ]);

            DB::table('reservations')->insert(
            [
                'domain_organization' =>'さんかく市',
                'date_reservation'=>('20221101'),
                'email_staff'=>'test2@test.com',
                'text_remarks'=>'テスト3',
                'created_at'=>('20220927'),
            ]);

            DB::table('reservations')->insert(
                [
                    'domain_organization' =>'さんかく市',
                    'date_reservation'=>('20221001'),
                    'email_staff'=>'test4@test.com',
                    'text_remarks'=>'テスト4',
                    'created_at'=>('20221201'),
                ]);

                DB::table('reservations')->insert(
                    [
                        'domain_organization' =>'さんかく市',
                        'date_reservation'=>('20221001'),
                        'email_staff'=>'admin@admin.com',
                        'text_remarks'=>'テスト１',
                        'created_at'=>('20220926'),
                    ]);
        
                    DB::table('reservations')->insert(
                        [
                            'domain_organization' =>'さんかく市',
                            'date_reservation'=>('20221002'),
                            'email_staff'=>'admin@admin.com',
                            'text_remarks'=>'テスト2',
                            'created_at'=>('20221001'),
                        ]);
        
                    DB::table('reservations')->insert(
                    [
                        'domain_organization' =>'さんかく市',
                        'date_reservation'=>('20221101'),
                        'email_staff'=>'admin@admin.com',
                        'text_remarks'=>'テスト3',
                        'created_at'=>('20220927'),
                    ]);
        
                    DB::table('reservations')->insert(
                        [
                            'domain_organization' =>'さんかく市',
                            'date_reservation'=>('20220901'),
                            'email_staff'=>'admin@admin.com',
                            'text_remarks'=>'テスト4',
                            'created_at'=>('20221201'),
                        ]);
                        DB::table('reservations')->insert(
                            [
                                'domain_organization' =>'さんかく市',
                                'date_reservation'=>('20221001'),
                                'email_staff'=>'test@test.com',
                                'text_remarks'=>'テスト１',
                                'created_at'=>('20220926'),
                            ]);
                
                            DB::table('reservations')->insert(
                                [
                                    'domain_organization' =>'さんかく市',
                                    'date_reservation'=>('20221002'),
                                    'email_staff'=>'test1@test.com',
                                    'text_remarks'=>'テスト2',
                                    'created_at'=>('20221001'),
                                ]);
                
                            DB::table('reservations')->insert(
                            [
                                'domain_organization' =>'さんかく市',
                                'date_reservation'=>('20221101'),
                                'email_staff'=>'test2@test.com',
                                'text_remarks'=>'テスト3',
                                'created_at'=>('20220927'),
                            ]);
                
                            DB::table('reservations')->insert(
                                [
                                    'domain_organization' =>'さんかく市',
                                    'date_reservation'=>('20221001'),
                                    'email_staff'=>'test4@test.com',
                                    'text_remarks'=>'テスト4',
                                    'created_at'=>('20221201'),
                                ]);
                
                                DB::table('reservations')->insert(
                                    [
                                        'domain_organization' =>'さんかく市',
                                        'date_reservation'=>('20221001'),
                                        'email_staff'=>'admin@admin.com',
                                        'text_remarks'=>'テスト１',
                                        'created_at'=>('20220926'),
                                    ]);
                        
                                    DB::table('reservations')->insert(
                                        [
                                            'domain_organization' =>'さんかく市',
                                            'date_reservation'=>('20221002'),
                                            'email_staff'=>'admin@admin.com',
                                            'text_remarks'=>'テスト2',
                                            'created_at'=>('20221001'),
                                        ]);
                        
                                    DB::table('reservations')->insert(
                                    [
                                        'domain_organization' =>'さんかく市',
                                        'date_reservation'=>('20221101'),
                                        'email_staff'=>'admin@admin.com',
                                        'text_remarks'=>'テスト3',
                                        'created_at'=>('20220927'),
                                    ]);
                        
                                    DB::table('reservations')->insert(
                                        [
                                            'domain_organization' =>'さんかく市',
                                            'date_reservation'=>('20220901'),
                                            'email_staff'=>'admin@admin.com',
                                            'text_remarks'=>'テスト4',
                                            'created_at'=>('20221201'),
                                        ]);        

    }
}
