<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Submission;
use App\Vote;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;
use Request;
use App\Submission_reply;

class Submission extends Model
{
    //
    public function votes(){
        return $this->hasMany('App\Vote');
    }

    public function replies(){
        return $this->hasMany('App\Vote');
    }

    public function score(){
    	return Vote::where('submission_id', $this->id)->sum('value');
    }

    public function votevalue(){
    	$value = Cookie::get('userToken');

    	$id = $this->id;

    	$ip = explode(",",app('request')->header('x-forwarded-for'));

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
        return substr(md5($this['user-agent'] . $this->ip . "დედის მუტელი"), -10, 5);
    }

    public function replyconut(){
        return Submission_reply::where('submission_id', $this->id)->count();
    }

    public function upvote(Illuminate\Http\Request $request){

        $value = Cookie::get('userToken');
    	$ip = explode(",", $request->header('x-forwarded-for'));
        $ip = $ip[0];

        if($value){
            if(Vote::where('cookie', $value)->where('submission_id', $this->id)->count() == 0){
				$vote = new Vote;

				$vote->submission_id = $this->id;
				$vote->cookie = $value;
    			$vote->ip = $ip;
    			$vote['user-agent'] = $request->header('User-Agent');
                $vote->value = 1;

    			$vote->save();

    		} else {
    			$vote = Vote::where('cookie', $value)->where('submission_id', $this->id)->first();

    			if($vote->value == 1){
    				$vote->delete();
    			} else {

    				$vote->value = 1;
                    $vote->save();
                    
    			}
    		}
        } else {
            if(Vote::where('submission_id', $this->id)->where('user-agent', $request->header('User-Agent'))->where('ip', $ip)->where('created_at', '>=', Carbon::now()->subHours(1)->toDateTimeString())->count() == 0){
	    		
	    		$token = str_random(40);

	    		$vote = new Vote;

	    		$vote->submission_id = $this->id;

    			$vote->value = 1;
    			$vote->cookie = $token;
    			$vote->ip = $ip;
    			$vote['user-agent'] = $request->header('User-Agent');

    			$vote->save();

	    	} else {
	    		$vote = Vote::where('submission_id', $this->id)->where('user-agent', $request->header('User-Agent'))->where('ip', $ip)->where('created_at', '>=', Carbon::now()->subHours(1)->toDateTimeString())->first();

    			if($vote->value == 1){

    				$vote->delete();

    			} else {

    				$vote->value = 1;

    				$vote->save();

    			}
	    	}
        }

        return 'true';
    }

    public function downvote(Illuminate\Http\Request $request){

        $value = Cookie::get('userToken');
    	$ip = explode(",", $request->header('x-forwarded-for'));
        $ip = $ip[0];

        if($value){
            if(Vote::where('cookie', $value)->where('submission_id', $this->id)->count() == 0){
				$vote = new Vote;

				$vote->submission_id = $this->id;
				$vote->cookie = $value;
    			$vote->ip = $ip;
    			$vote['user-agent'] = $request->header('User-Agent');
                $vote->value = -1;

    			$vote->save();

    		} else {
    			$vote = Vote::where('cookie', $value)->where('submission_id', $this->id)->first();

    			if($vote->value == -1){
    				$vote->delete();
    			} else {

    				$vote->value = -1;
                    $vote->save();
                    
    			}
    		}
        } else {
            if(Vote::where('submission_id', $this->id)->where('user-agent', $request->header('User-Agent'))->where('ip', $ip)->where('created_at', '>=', Carbon::now()->subHours(1)->toDateTimeString())->count() == 0){
	    		
	    		$token = str_random(40);

	    		$vote = new Vote;

	    		$vote->submission_id = $this->id;

    			$vote->value = -1;
    			$vote->cookie = $token;
    			$vote->ip = $ip;
    			$vote['user-agent'] = $request->header('User-Agent');

    			$vote->save();

	    	} else {
	    		$vote = Vote::where('submission_id', $this->id)->where('user-agent', $request->header('User-Agent'))->where('ip', $ip)->where('created_at', '>=', Carbon::now()->subHours(1)->toDateTimeString())->first();

    			if($vote->value == -1){

    				$vote->delete();

    			} else {

    				$vote->value = -1;

    				$vote->save();

    			}
	    	}
        }

        return 'true';

    }
}
