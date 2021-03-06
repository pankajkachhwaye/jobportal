<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RecruiterModel extends Model
{
    use Notifiable;
    protected $table = 'recruiter';

    protected $fillable = [
        'organisation_name', 'recruiter_email', 'recruiter_mobile_no', 'password','device_id','device_token','device_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot() {
        parent::boot();

        static::creating(function ($user) {
            $user->token = str_random(40);
        });
    }

    public function hasVerified() {

        $this->recruiter_verified = true;
        $this->token = '0';

        $this->save();
    }

    public function scopeGetRecruiterByMobOrEmail($query ,$value){
        return $query->where('recruiter_email', $value)
            ->orWhere('recruiter_mobile_no', $value);
    }

    public function scopeGetRecruiterByEmail($query,$email){
        return $query->where('recruiter_email', $email);
    }
    public function scopeGetRecruiterByMob($query,$mobile){
        return $query->where('recruiter_mobile_no', $mobile);
    }

    public function recruiterProfile(){

        return $this->hasOne('App\Models\RecruiterProfile','recruiter_id');
    }

    public function postedJobs(){
        return $this->hasMany('App\Models\JobsModel','recruiter_id');
    }


        public function getTokenAttribute($value)
    {
        return ($value == null ? '':$value);
    }

    public function getUpdatedAtAttribute($value)
    {
        return ($value == null ? '':$value);
    }
//
//    public function getUpdatedAtAttribute($value)
//    {
//        return ($value == null ? '':$value);
//    }

    public function getDeviceIdAttribute($value)
    {
        return ($value == null ? '':$value);
    }

    public function getDeviceTokenAttribute($value)
    {
        return ($value == null ? '':$value);
    }

    public function getDeviceTypeAttribute($value)
    {
        return ($value == null ? '':$value);
    }
}
