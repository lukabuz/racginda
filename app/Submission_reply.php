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

    public function getid(){
        return substr(md5($this['user-agent'] . $this->ip . "დედის მუტელი"), -10, 5);
    }
}
