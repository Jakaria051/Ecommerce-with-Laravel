<?php

use App\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->truncate();
        $adminsRecords = [
            [
                'id'=>1,'name'=>'admin','type'=>'admin','mobile'=>'01621417585',
                'email'=>'admin@admin.com','password'=>'$2y$10$gLCx/iRjHnC3G1u0cP2Zauaj0OgLHH9vL82tphj3MFbO6o0/5xzFi','image'=>'','status'=>1
            ],
            [
                'id'=>2,'name'=>'jakaria','type'=>'subadmin','mobile'=>'01621417585',
                'email'=>'jakaria@admin.com','password'=>'$2y$10$gLCx/iRjHnC3G1u0cP2Zauaj0OgLHH9vL82tphj3MFbO6o0/5xzFi','image'=>'','status'=>1
            ],
            [
                'id'=>3,'name'=>'jacjakaria','type'=>'subadmin','mobile'=>'01621417585',
                'email'=>'jacjakaiar@admin.com','password'=>'$2y$10$gLCx/iRjHnC3G1u0cP2Zauaj0OgLHH9vL82tphj3MFbO6o0/5xzFi','image'=>'','status'=>1
            ],
            [
                'id'=>4,'name'=>'john','type'=>'admin','mobile'=>'01621417585',
                'email'=>'john@admin.com','password'=>'$2y$10$gLCx/iRjHnC3G1u0cP2Zauaj0OgLHH9vL82tphj3MFbO6o0/5xzFi','image'=>'','status'=>1
            ],
        ];

        // foreach ($adminsRecords as $key => $record) {
        //     Admin::create($record);
        // }

        DB::table('admins')->insert($adminsRecords);

    }
}
