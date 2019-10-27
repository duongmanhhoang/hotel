<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Analytic extends Model
{
    const WEEKLY = 1;
    const MONTHLY = 2;
    const YEAR = 3;
    const ADVANCE = 4;
    const TODAY_ACCESS = 1;
    const YESTERDAY_ACCESS = 2;
    const WEEK_AGO_ACCESS = 3;
    const MONTH_AGO_ACCESS = 4;

    protected $fillable = [
        'page',
        'time',
        'ip'
    ];
}
