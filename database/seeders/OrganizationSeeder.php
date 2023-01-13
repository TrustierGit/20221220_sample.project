<?php


namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Organization;



class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organizations')->insert([
        [
            'domain_organization'=>'marumaru.co.jp',
            'name_organization'=>'まるまる市',
            'stored_server'=>'server1',
            'count_license'=>10,
            'date_maintenance'=>'2029-12-31',
           
            
        ],
        [
                'domain_organization'=>'test1.co.jp',
                'name_organization'=>'test1市',
                'stored_server'=>'server1',
                'count_license'=>10,
                'date_maintenance'=>'2029-12-31',
                
                
            ],
        
                [
                    'domain_organization'=>'test2.co.jp',
                    'name_organization'=>'test2市',
                    'stored_server'=>'server3',
                    'count_license'=>10,
                    'date_maintenance'=>'2029-12-31',
                  
                ],
       

    ]);
}

}
