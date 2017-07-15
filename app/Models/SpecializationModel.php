<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecializationModel extends Model
{
   protected $table = 'specializations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'specialization'
    ];
}
