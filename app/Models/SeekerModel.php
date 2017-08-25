<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class SeekerModel extends Model
{
    protected $table = 'seeker';

    protected $fillable = [
        'full_name', 'email', 'mobile_no', 'password'
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

        $this->verified = true;
        $this->token = '0';

        $this->save();
    }

    public function scopeGetSeekerByMobOrEmail($query,$value){

      return $query->where('email', $value)
            ->orWhere('mobile_no', $value);
    }

    public function scopeGetSeekerByMob($query,$mobile){
        return $query->where('mobile_no', $mobile);

    }

    public function scopeGetSeekerByEmail($query,$email){

        return $query->where('email', $email);

    }

    public function seekerProfile(){
        return $this->hasOne('App\Models\SeekerProfile','seeker_id');
    }


    public function seekerApplications(){
        return $this->hasMany('App\Models\ApplyOnJobModel','seeker_id');
    }

    public function getProfileUpdateAttribute($value)
    {
        return ($value == null ? '':$value);
    }
}
