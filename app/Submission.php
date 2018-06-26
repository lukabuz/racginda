<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Submission;
use App\Vote;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;
use Request;

class Submission extends Model
{
    //
    public function votes()
    {
        return $this->hasMany('App\Vote');
    }

    public function score(){
    	return Vote::where('submission_id', $this->id)->sum('value');
    }

    public function votevalue(){
    	$value = Cookie::get('userToken');

    	$id = $this->id;

    	$ip = app('request')->header('x-forwarded-for');

    	$ip = explode(",",$ip);

        $ip = $ip[0];

    	if($value){
    		if(Vote::where('cookie', $value)->where('submission_id', $id)->count() == 0){
    			return 0;
    		} else{
    			return Vote::where('cookie', $value)->where('submission_id', $id)->first()->value;
    		}

    	} else {
    		if(Vote::where('submission_id', $id)->where('user-agent', \Request::header('User-Agent'))->where('ip', $ip)->where('created_at', '>=', Carbon::now()->subHours(1)->toDateTimeString())->count() == 0){
    			return 0;
    		}

    		return Vote::where('submission_id', $id)->where('user-agent', \Request::header('User-Agent'))->where('ip', $ip)->where('created_at', '>=', Carbon::now()->subHours(1)->toDateTimeString())->first()->value;
    	}
    }

    public function getid(){
        $id = md5($this['user-agent'] . $this->ip . "დედის მუტელი");

        return substr($id, -10, 5);
    }
}
