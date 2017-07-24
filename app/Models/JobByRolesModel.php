<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobByRolesModel extends Model
{
    protected $table = 'job_by_roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_by_role'
    ];

    public function jobsByRoles(){
        return $this->hasMany('App\Models\JobsModel','job_by_roles');
    }
}
