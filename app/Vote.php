<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    //
    public function submission()
    {
        return $this->belongsTo('App\Submission');
    }
}
