<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaOfSectorsModel extends Model
{
    protected $table ='area_of_sectors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'area_of_sector'
    ];
}
