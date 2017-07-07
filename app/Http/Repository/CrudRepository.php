<?php

namespace App\Http\Repository;


use App\Models\AddressModel;
use App\Models\CouponModel;
use App\Models\DeliveryInformationModel;
use App\Models\DiscountModel;
use App\Models\TimingModel;
use Carbon\Carbon;

class CrudRepository
{

    public function createNew($data = [], $modal)
    {
        try {
            $data['created_at'] = Carbon::now();
            $modal->create($data);
            return ['code' => 101, 'message' => 'success'];
        } catch (\Exception $exception) {
            return ['code' => 503, 'message' => $exception->getMessage()];
        }

    }

}