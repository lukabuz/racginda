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

    public function votevalue(){
    	$value = Cookie::get('userToken');

    	$id = $this->id;

    	if($value){
    		if(Vote::where('cookie', $value)->where('submission_id', $id)->count() == 0){
    			return 0;
    		} else{
    			return Vote::where('cookie', $value)->where('submission_id', $id)->first()->get()->value;
    		}

    	} else {
    		if(Vote::where('submission_id', $id)->where('user-agent', \Request::header('User-Agent'))->where('ip', \Request::ip())->where('created_at', '>=', Carbon::now()->subHours(1)->toDateTimeString())->count() == 0){
    			return 0;
    		}

    		return Vote::where('submission_id', $id)->where('user-agent', \Request::header('User-Agent'))->where('ip', \Request::ip())->where('created_at', '>=', Carbon::now()->subHours(1)->toDateTimeString())->first()->get()->value;
    	}
    }
}
