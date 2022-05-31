<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContestSubscription extends Model
{
     protected $fillable = [
        'user_id', 'contest_id'
    ];
}
