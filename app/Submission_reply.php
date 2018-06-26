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
        $id = md5($this['user-agent'] . $this->ip . "დედის მუტელი");

        return substr($id, -10, 5);
    }
}
