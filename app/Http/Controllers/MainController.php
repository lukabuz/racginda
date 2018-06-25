<?php

namespace App\Http\Controllers;

use Request;
use App\Submission;
use App\Vote;
use Illuminate\Support\Facades\Cookie;

class MainController extends Controller
{
    //
    public function index(Illuminate\Http\Request $request){
    	return view('main');
    }

    public function submit(Illuminate\Http\Request $request){

    	if(strlen($request->input('text')) > 1200){
    		return redirect('/')->with('error', 'თქვენი პოსტი ძალიან გრძელია!');
    	}

    	$value = Cookie::get('userToken');

    	if($value){
    		if(Submission::where('cookie', $value)->where('created_at', '>=', Carbon::now()->subMinutes(5)->toDateTimeString())->count() == 0){
    			$submission = new Submission;

    			$submission->description = $request->input('text');
    			$submission->cookie = $value;
    			$submission->ip = Request::ip();
    			$submission['user-agent'] = $request->header('User-Agent');

    			$submission->save();

    			return redirect('/')->with('message', 'თქვენი პოსტი დამატებულია!');
    		} else {
    			return redirect('/')->with('error', 'თქვენ ამის გაკეთება მხოლოდ 5 წუთში ერთხელ შეგიძლიათ');
    		}
    	} else {
    		if(Submission::where('user-agent', $request->header('User-Agent'))->where('ip', Request::ip())->where('created_at', '>=', Carbon::now()->subDays(2)->toDateTimeString())->count == 0){
	    		
	    		$token = str_random(40);

	    		$submission = new Submission;

    			$submission->description = $request->input('text');
    			$submission->cookie = $token;
    			$submission->ip = Request::ip();
    			$submission['user-agent'] = $request->header('User-Agent');

    			$submission->save();

	    		return redirect('/')->with('message', 'თქვენი პოსტი დამატებულია!')->withCookie(Cookie::forever('userToken', $token));
	    	}
    	}
    }
}
