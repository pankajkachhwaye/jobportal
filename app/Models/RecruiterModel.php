<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecruiterModel extends Model
{
    protected $table = 'recruiter';

    protected $fillable = [
        'organisation_name', 'recruiter_email', 'recruiter_mobile_no', 'password'
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
        $this->token = null;

        $this->save();
    }

    public function scopeGetRecruiterByMobOrEmail($query ,$value){
        return $query->where('recruiter_email', $value)
            ->orWhere('recruiter_mobile_no', $value);
    }

    public function recruiterProfile(){

        return $this->hasOne('App\Models\RecruiterProfile','recruiter_id');
    }

    public function postedJobs(){
        return $this->hasMany('App\Models\JobsModel','recruiter_id');
    }



}
