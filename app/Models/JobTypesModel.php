<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobTypesModel extends Model
{
    protected $table = 'job_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_type'
    ];
}
