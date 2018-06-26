<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Submission;
use App\Submission_reply;
use App\Vote;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SubmissionsController extends Controller
{
    //
    public function show(Request $request, $id){
    	$submission = Submission::findOrFail($id);

    	return $submission;
    }

    public function reply(Request $request, $id){
    	$parentsubmission = Submission::findOrFail($id);


    	$ip = $request->header('x-forwarded-for');

    	$ip = explode(",",$ip);

        $ip = $ip[0];

    	if(strlen($request->input('text')) > 1200){
    		return redirect('back')->with('error', 'თქვენი პოსტი ძალიან გრძელია!');
    	}

        if(strlen($request->input('text')) < 2){
            return redirect('back')->with('error', 'თქვენი პოსტი ძალიან მოკლეა!');
        }

    	$value = Cookie::get('userToken');

    	if($value){
    		if(Submission_reply::where('cookie', $value)->where('created_at', '>=', Carbon::now()->subMinutes(5)->toDateTimeString())->count() == 0){
    			$submission = new Submission_reply;

    			$submission->submission_id = $parentsubmission->id;
    			$submission->description = $request->input('text');
    			$submission->cookie = $value;
    			$submission->ip = $ip;
    			$submission['user-agent'] = $request->header('User-Agent');

    			$submission->save();

    			return redirect('back')->with('message', 'თქვენი პოსტი დამატებულია!');
    		} else {
    			return redirect('back')->with('error', 'თქვენ ამის გაკეთება მხოლოდ 5 წუთში ერთხელ შეგიძლიათ');
    		}
    	} else {
    		if(Submission_reply::where('user-agent', $request->header('User-Agent'))->where('ip', $ip)->where('created_at', '>=', Carbon::now()->subMinutes(5)->toDateTimeString())->count() == 0){
	    		
	    		$token = str_random(40);

	    		$submission = new Submission_reply;

	    		$submission->submission_id = $parentsubmission->id;
    			$submission->description = $request->input('text');
    			$submission->cookie = $token;
    			$submission->ip = $ip;
    			$submission['user-agent'] = $request->header('User-Agent');

    			$submission->save();

	    		return redirect('back')->with('message', 'თქვენი პოსტი დამატებულია!')->withCookie(Cookie::forever('userToken', $token));
	    	} else {
	    		return redirect('back')->with('error', 'თქვენ ამის გაკეთება მხოლოდ 5 წუთში ერთხელ შეგიძლიათ');
	    	}
    	}
    }
}
