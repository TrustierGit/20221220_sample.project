<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Holiday;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    
    public function run()
    {
        $now = Carbon::now();

        DB::table('holidays')->insert(['date_holiday'=>'2023-01-01','name_holiday'=>'元日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2023-01-02','name_holiday'=>'振替休日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2023-01-09','name_holiday'=>'成人の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2023-02-11','name_holiday'=>'建国記念の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2023-02-23','name_holiday'=>'天皇誕生日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2023-03-21','name_holiday'=>'春分の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2023-04-29','name_holiday'=>'昭和の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2023-05-03','name_holiday'=>'憲法記念日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2023-05-04','name_holiday'=>'みどりの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2023-05-05','name_holiday'=>'こどもの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2023-07-17','name_holiday'=>'海の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2023-08-11','name_holiday'=>'山の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2023-09-18','name_holiday'=>'敬老の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2023-09-23','name_holiday'=>'秋分の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2023-10-09','name_holiday'=>'スポーツの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2023-11-03','name_holiday'=>'文化の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2023-11-23','name_holiday'=>'勤労感謝の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2024-01-01','name_holiday'=>'元日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2024-01-08','name_holiday'=>'成人の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2024-02-11','name_holiday'=>'建国記念の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2024-02-12','name_holiday'=>'振替休日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2024-02-23','name_holiday'=>'天皇誕生日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2024-03-20','name_holiday'=>'春分の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2024-04-29','name_holiday'=>'昭和の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2024-05-03','name_holiday'=>'憲法記念日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2024-05-04','name_holiday'=>'みどりの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2024-05-05','name_holiday'=>'こどもの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2024-05-06','name_holiday'=>'振替休日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2024-07-15','name_holiday'=>'海の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2024-08-11','name_holiday'=>'山の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2024-08-12','name_holiday'=>'振替休日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2024-09-16','name_holiday'=>'敬老の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2024-09-22','name_holiday'=>'秋分の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2024-09-23','name_holiday'=>'振替休日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2024-10-14','name_holiday'=>'スポーツの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2024-11-03','name_holiday'=>'文化の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2024-11-04','name_holiday'=>'振替休日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2024-11-23','name_holiday'=>'勤労感謝の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2025-01-01','name_holiday'=>'元日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2025-01-13','name_holiday'=>'成人の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2025-02-11','name_holiday'=>'建国記念の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2025-02-23','name_holiday'=>'天皇誕生日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2025-02-24','name_holiday'=>'振替休日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2025-03-20','name_holiday'=>'春分の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2025-04-29','name_holiday'=>'昭和の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2025-05-03','name_holiday'=>'憲法記念日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2025-05-04','name_holiday'=>'みどりの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2025-05-05','name_holiday'=>'こどもの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2025-05-06','name_holiday'=>'振替休日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2025-07-21','name_holiday'=>'海の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2025-08-11','name_holiday'=>'山の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2025-09-15','name_holiday'=>'敬老の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2025-09-23','name_holiday'=>'秋分の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2025-10-13','name_holiday'=>'スポーツの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2025-11-03','name_holiday'=>'文化の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2025-11-23','name_holiday'=>'勤労感謝の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2025-11-24','name_holiday'=>'振替休日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2026-01-01','name_holiday'=>'元日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2026-01-12','name_holiday'=>'成人の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2026-02-11','name_holiday'=>'建国記念の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2026-02-23','name_holiday'=>'天皇誕生日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2026-03-20','name_holiday'=>'春分の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2026-04-29','name_holiday'=>'昭和の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2026-05-03','name_holiday'=>'憲法記念日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2026-05-04','name_holiday'=>'みどりの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2026-05-05','name_holiday'=>'こどもの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2026-05-06','name_holiday'=>'振替休日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2026-07-20','name_holiday'=>'海の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2026-08-11','name_holiday'=>'山の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2026-09-21','name_holiday'=>'敬老の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2026-09-22','name_holiday'=>'国民の休日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2026-09-23','name_holiday'=>'秋分の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2026-10-12','name_holiday'=>'スポーツの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2026-11-03','name_holiday'=>'文化の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2026-11-23','name_holiday'=>'勤労感謝の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2027-01-01','name_holiday'=>'元日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2027-01-11','name_holiday'=>'成人の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2027-02-11','name_holiday'=>'建国記念の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2027-02-23','name_holiday'=>'天皇誕生日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2027-03-21','name_holiday'=>'春分の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2027-03-22','name_holiday'=>'振替休日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2027-04-29','name_holiday'=>'昭和の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2027-05-03','name_holiday'=>'憲法記念日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2027-05-04','name_holiday'=>'みどりの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2027-05-05','name_holiday'=>'こどもの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2027-07-19','name_holiday'=>'海の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2027-08-11','name_holiday'=>'山の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2027-09-20','name_holiday'=>'敬老の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2027-09-23','name_holiday'=>'秋分の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2027-10-11','name_holiday'=>'スポーツの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2027-11-03','name_holiday'=>'文化の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2027-11-23','name_holiday'=>'勤労感謝の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2028-01-01','name_holiday'=>'元日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2028-01-10','name_holiday'=>'成人の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2028-02-11','name_holiday'=>'建国記念の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2028-02-23','name_holiday'=>'天皇誕生日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2028-03-20','name_holiday'=>'春分の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2028-04-29','name_holiday'=>'昭和の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2028-05-03','name_holiday'=>'憲法記念日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2028-05-04','name_holiday'=>'みどりの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2028-05-05','name_holiday'=>'こどもの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2028-07-17','name_holiday'=>'海の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2028-08-11','name_holiday'=>'山の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2028-09-18','name_holiday'=>'敬老の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2028-09-22','name_holiday'=>'秋分の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2028-10-09','name_holiday'=>'スポーツの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2028-11-03','name_holiday'=>'文化の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2028-11-23','name_holiday'=>'勤労感謝の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2029-01-01','name_holiday'=>'元日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2029-01-08','name_holiday'=>'成人の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2029-02-11','name_holiday'=>'建国記念の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2029-02-12','name_holiday'=>'振替休日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2029-02-23','name_holiday'=>'天皇誕生日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2029-03-20','name_holiday'=>'春分の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2029-04-29','name_holiday'=>'昭和の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2029-04-30','name_holiday'=>'振替休日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2029-05-03','name_holiday'=>'憲法記念日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2029-05-04','name_holiday'=>'みどりの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2029-05-05','name_holiday'=>'こどもの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2029-07-16','name_holiday'=>'海の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2029-08-11','name_holiday'=>'山の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2029-09-17','name_holiday'=>'敬老の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2029-09-23','name_holiday'=>'秋分の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2029-09-24','name_holiday'=>'振替休日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2029-10-08','name_holiday'=>'スポーツの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2029-11-03','name_holiday'=>'文化の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2029-11-23','name_holiday'=>'勤労感謝の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2030-01-01','name_holiday'=>'元日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2030-01-14','name_holiday'=>'成人の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2030-02-11','name_holiday'=>'建国記念の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2030-02-23','name_holiday'=>'天皇誕生日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2030-03-20','name_holiday'=>'春分の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2030-04-29','name_holiday'=>'昭和の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2030-05-03','name_holiday'=>'憲法記念日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2030-05-04','name_holiday'=>'みどりの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2030-05-05','name_holiday'=>'こどもの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2030-05-06','name_holiday'=>'振替休日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2030-07-15','name_holiday'=>'海の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2030-08-11','name_holiday'=>'山の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2030-08-12','name_holiday'=>'振替休日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2030-09-16','name_holiday'=>'敬老の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2030-09-23','name_holiday'=>'秋分の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2030-10-14','name_holiday'=>'スポーツの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2030-11-03','name_holiday'=>'文化の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2030-11-04','name_holiday'=>'振替休日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2030-11-23','name_holiday'=>'勤労感謝の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2031-01-01','name_holiday'=>'元日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2031-01-13','name_holiday'=>'成人の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2031-02-11','name_holiday'=>'建国記念の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2031-02-23','name_holiday'=>'天皇誕生日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2031-02-24','name_holiday'=>'振替休日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2031-03-21','name_holiday'=>'春分の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2031-04-29','name_holiday'=>'昭和の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2031-05-03','name_holiday'=>'憲法記念日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2031-05-04','name_holiday'=>'みどりの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2031-05-05','name_holiday'=>'こどもの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2031-05-06','name_holiday'=>'振替休日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2031-07-21','name_holiday'=>'海の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2031-08-11','name_holiday'=>'山の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2031-09-15','name_holiday'=>'敬老の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2031-09-23','name_holiday'=>'秋分の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2031-10-13','name_holiday'=>'スポーツの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2031-11-03','name_holiday'=>'文化の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2031-11-23','name_holiday'=>'勤労感謝の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2031-11-24','name_holiday'=>'振替休日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2032-01-12','name_holiday'=>'成人の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2032-02-11','name_holiday'=>'建国記念の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2032-02-23','name_holiday'=>'天皇誕生日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2032-03-20','name_holiday'=>'春分の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2032-04-29','name_holiday'=>'昭和の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2032-05-03','name_holiday'=>'憲法記念日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2032-05-04','name_holiday'=>'みどりの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2032-05-05','name_holiday'=>'こどもの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2032-07-19','name_holiday'=>'海の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2032-08-11','name_holiday'=>'山の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2032-09-20','name_holiday'=>'敬老の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2032-09-21','name_holiday'=>'国民の休日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2032-09-22','name_holiday'=>'秋分の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2032-10-11','name_holiday'=>'スポーツの日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2032-11-03','name_holiday'=>'文化の日','created_at'=> $now,'updated_at'=> $now,]);
        DB::table('holidays')->insert(['date_holiday'=>'2032-11-23','name_holiday'=>'勤労感謝の日','created_at'=> $now,'updated_at'=> $now,]);
        
    }
}
