<?php

use Illuminate\Database\Seeder;

class BasicInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $location = [
            'category_01' => ['location_name'=>'Mumbai', 'created_at' => \Carbon\Carbon::now()],
            'category_02' => ['location_name'=>'Dehli', 'created_at' => \Carbon\Carbon::now()],
            'category_03' => ['location_name'=>'Pune', 'created_at' => \Carbon\Carbon::now()],
            'category_04' => ['location_name'=>'Banglore', 'created_at' => \Carbon\Carbon::now()],
            'category_05' => ['location_name'=>'Indore', 'created_at' => \Carbon\Carbon::now()],
        ];

        foreach ($location as $code => $sys) {
            $mem = new \App\Models\LocationModel();
            $mem->location_name = $sys['location_name'];
            $mem->created_at = $sys['created_at'];
            $mem->save();
        }

        $area_sectors = [
            'category_01' => ['area_of_sector'=>'IT Development', 'created_at' => \Carbon\Carbon::now()],
            'category_02' => ['area_of_sector'=>'IT Networking', 'created_at' => \Carbon\Carbon::now()],
            'category_03' => ['area_of_sector'=>'Marketing', 'created_at' => \Carbon\Carbon::now()],
            'category_04' => ['area_of_sector'=>'Finance', 'created_at' => \Carbon\Carbon::now()],
            'category_05' => ['area_of_sector'=>'Sales', 'created_at' => \Carbon\Carbon::now()],

        ];

        foreach ($area_sectors as $code => $sys) {
            $mem = new \App\Models\AreaOfSectorsModel();
            $mem->area_of_sector = $sys['area_of_sector'];
            $mem->created_at = $sys['created_at'];
            $mem->save();
        }

        $specialization = [
            'category_01' => ['specialization'=>'UI Developer', 'created_at' => \Carbon\Carbon::now()],
            'category_06' => ['specialization'=>'Full Stack Developer', 'created_at' => \Carbon\Carbon::now()],
            'category_07' => ['specialization'=>'Interior Designer', 'created_at' => \Carbon\Carbon::now()],
            'category_08' => ['specialization'=>'HR/Admin', 'created_at' => \Carbon\Carbon::now()],
            'category_09' => ['specialization'=>'Surgon', 'created_at' => \Carbon\Carbon::now()],
        ];

        foreach ($specialization as $code => $sys) {
            $mem = new \App\Models\SpecializationModel();
            $mem->specialization = $sys['specialization'];
            $mem->created_at = $sys['created_at'];
            $mem->save();
        }


        $qualification = [
            'category_01' => ['qualification'=>'BE/B.Tech', 'created_at' => \Carbon\Carbon::now()],
            'category_02' => ['qualification'=>'ME/M.Tech', 'created_at' => \Carbon\Carbon::now()],
            'category_03' => ['qualification'=>'B.Ed', 'created_at' => \Carbon\Carbon::now()],
            'category_04' => ['qualification'=>'MBBS', 'created_at' => \Carbon\Carbon::now()],
            'category_05' => ['qualification'=>'M.Com', 'created_at' => \Carbon\Carbon::now()],

        ];

        foreach ($qualification as $code => $sys) {
            $mem = new \App\Models\QualificationModel();
            $mem->qualification = $sys['qualification'];
            $mem->created_at = $sys['created_at'];
            $mem->save();
        }

//        $job_role = [
//            'category_01' => ['job_by_role'=>'Senior Developer', 'created_at' => \Carbon\Carbon::now()],
//            'category_06' => ['job_by_role'=>'HR Manager', 'created_at' => \Carbon\Carbon::now()],
//            'category_07' => ['job_by_role'=>'Project Manager', 'created_at' => \Carbon\Carbon::now()],
//            'category_08' => ['job_by_role'=>'CEO', 'created_at' => \Carbon\Carbon::now()],
//
//
//        ];
//
//        foreach ($job_role as $code => $sys) {
//            $mem = new \App\Models\JobByRolesModel();
//            $mem->job_by_role = $sys['job_by_role'];
//            $mem->created_at = $sys['created_at'];
//            $mem->save();
//        }

        $job_type = [
            'category_01' => ['job_type'=>'Full Time', 'created_at' => \Carbon\Carbon::now()],
            'category_02' => ['job_type'=>'Part Time', 'created_at' => \Carbon\Carbon::now()],
            'category_03' => ['job_type'=>'Work From Home', 'created_at' => \Carbon\Carbon::now()],



        ];

        foreach ($job_type as $code => $sys) {
            $mem = new \App\Models\JobTypesModel();
            $mem->job_type = $sys['job_type'];
            $mem->created_at = $sys['created_at'];
            $mem->save();
        }
    }
}
