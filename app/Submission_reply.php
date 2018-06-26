<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission_reply extends Model
{
    //
    public function submission()
    {
        return $this->belongsTo('App\Submission');
    }
}
