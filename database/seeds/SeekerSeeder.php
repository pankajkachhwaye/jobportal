<?php

use Illuminate\Database\Seeder;

class SeekerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeker = [
            'category_01' => ['full_name'=>'Pankaj','email'=>'pankaj@samyo.com','mobile_no'=>'9827698550','password'=>bcrypt('123456'),'profile_update'=>false,'verified'=>true, 'token'=>null,'created_at' => \Carbon\Carbon::now()],
            'category_01' => ['full_name'=>'Avanish','email'=>'avi@samyo.com','mobile_no'=>'123456789','password'=>bcrypt('123456'),'profile_update'=>false,'verified'=>true, 'token'=>null,'created_at' => \Carbon\Carbon::now()],

        ];

        foreach ($seeker as $code => $sys) {
            $mem = new \App\Models\SeekerModel();
            $mem->full_name = $sys['full_name'];
            $mem->email = $sys['email'];
            $mem->mobile_no = $sys['mobile_no'];
            $mem->password = $sys['password'];
            $mem->profile_update = $sys['profile_update'];
            $mem->verified = $sys['verified'];
            $mem->token = $sys['token'];
            $mem->created_at = $sys['created_at'];
            $mem->save();
        }
    }
}
