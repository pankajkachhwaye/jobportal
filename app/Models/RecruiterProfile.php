<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecruiterProfile extends Model
{
    protected $table = 'recruiter_profile';

    public function getOrgWebsiteAttribute($value)
    {
        return ($value == null ? '':$value);
    }

    public function getOrgLogoAttribute($value)
    {
        return ($value == null ? '':$value);
    }
}
