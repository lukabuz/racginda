<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Submission;
use App\Vote;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    //
    public function index(Request $request){
    	if($request->get('sort') == 'new'){
    		$submissions = Submission::where('created_at', '>=', Carbon::now()->subHours(24)->toDateTimeString())->orderBy('created_at', 'esc')->get();

    		return view('main')->with('submissions', $submissions);
    	}

    	$submissions = Submission::where('created_at', '>=', Carbon::now()->subHours(24)->toDateTimeString())->get();

    	$submissions = $submissions->sortByDesc(function ($product, $key) {
			$product->votecount = Vote::where('submission_id', $product->id)->sum('value');
			return $product->votecount;
		});

    	return view('main')->with('submissions', $submissions);
    }

    public function submit(Request $request){

    	$ip = $request->header('x-forwarded-for');

    	$ip = explode(",",$ip);

        $ip = $ip[0];

    	if(strlen($request->input('text')) > 1200){
    		return redirect('/')->with('error', 'თქვენი პოსტი ძალიან გრძელია!');
    	}

        if(strlen($request->input('text')) < 2){
            return redirect('/')->with('error', 'თქვენი პოსტი ძალიან მოკლეა!');
        }

    	$value = Cookie::get('userToken');

    	if($value){
    		if(Submission::where('cookie', $value)->where('created_at', '>=', Carbon::now()->subMinutes(5)->toDateTimeString())->count() == 0){
    			$submission = new Submission;

    			$submission->description = $request->input('text');
    			$submission->cookie = $value;
    			$submission->ip = $ip;
    			$submission['user-agent'] = $request->header('User-Agent');

    			$submission->save();

    			return redirect('/')->with('message', 'თქვენი პოსტი დამატებულია!');
    		} else {
    			return redirect('/')->with('error', 'თქვენ ამის გაკეთება მხოლოდ 5 წუთში ერთხელ შეგიძლიათ');
    		}
    	} else {
    		if(Submission::where('user-agent', $request->header('User-Agent'))->where('ip', $ip)->where('created_at', '>=', Carbon::now()->subMinutes(5)->toDateTimeString())->count() == 0){
	    		
	    		$token = str_random(40);

	    		$submission = new Submission;

    			$submission->description = $request->input('text');
    			$submission->cookie = $token;
    			$submission->ip = $ip;
    			$submission['user-agent'] = $request->header('User-Agent');

    			$submission->save();

	    		return redirect('/')->with('message', 'თქვენი პოსტი დამატებულია!')->withCookie(Cookie::forever('userToken', $token));
	    	} else {
	    		return redirect('/')->with('error', 'თქვენ ამის გაკეთება მხოლოდ 5 წუთში ერთხელ შეგიძლიათ');
	    	}
    	}
    }

    public function upvote(Request $request, $id){
    	$value = Cookie::get('userToken');

    	$submission = Submission::findOrFail($id);

    	$ip = $request->header('x-forwarded-for');

    	$ip = explode(",",$ip);

        $ip = $ip[0];

    	if($value){
    		if(Vote::where('cookie', $value)->where('submission_id', $id)->count() == 0){

				$vote = new Vote;

				$vote->submission_id = $id;

				$vote->cookie = $value;
    			$vote->ip = $ip;
    			$vote['user-agent'] = $request->header('User-Agent');

    			$vote->value = 1;

    			$vote->save();

    		} else {
    			$vote = Vote::where('cookie', $value)->where('submission_id', $id)->first();

    			if($vote->value == 1){

    				$vote->delete();

    			} else {

    				$vote->value = 1;

    				$vote->save();

    			}
    		}
    	} else {
    		if(Vote::where('submission_id', $id)->where('user-agent', $request->header('User-Agent'))->where('ip', $ip)->where('created_at', '>=', Carbon::now()->subHours(1)->toDateTimeString())->count() == 0){
	    		
	    		$token = str_random(40);

	    		$vote = new Vote;

	    		$vote->submission_id = $id;

    			$vote->value = 1;
    			$vote->cookie = $token;
    			$vote->ip = $ip;
    			$vote['user-agent'] = $request->header('User-Agent');

    			$vote->save();

	    	} else {
	    		$vote = Vote::where('submission_id', $id)->where('user-agent', $request->header('User-Agent'))->where('ip', $ip)->where('created_at', '>=', Carbon::now()->subHours(1)->toDateTimeString())->first();

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

    public function downvote(Request $request, $id){
    	$value = Cookie::get('userToken');

    	$submission = Submission::findOrFail($id);

    	$ip = $request->header('x-forwarded-for');

    	$ip = explode(",",$ip);

        $ip = $ip[0];

    	if($value){
    		if(Vote::where('cookie', $value)->where('submission_id', $id)->count() == 0){

				$vote = new Vote;

				$vote->submission_id = $id;

				$vote->cookie = $value;
    			$vote->ip = $ip;
    			$vote['user-agent'] = $request->header('User-Agent');

    			$vote->value = -1;

    			$vote->save();

    		} else {
    			$vote = Vote::where('cookie', $value)->where('submission_id', $id)->first();

    			if($vote->value == -1){

    				$vote->delete();

    			} else {

    				$vote->value = -1;

    				$vote->save();

    			}
    		}
    	} else {
    		if(Vote::where('submission_id', $id)->where('user-agent', $request->header('User-Agent'))->where('ip', $ip)->where('created_at', '>=', Carbon::now()->subHours(1)->toDateTimeString())->count() == 0){
	    		
	    		$token = str_random(40);

	    		$vote = new Vote;

	    		$vote->submission_id = $id;

    			$vote->value = -1;
    			$vote->cookie = $token;
    			$vote->ip = $ip;
    			$vote['user-agent'] = $request->header('User-Agent');

    			$vote->save();

	    	} else {
	    		$vote = Vote::where('submission_id', $id)->where('user-agent', $request->header('User-Agent'))->where('ip', $ip)->where('created_at', '>=', Carbon::now()->subHours(1)->toDateTimeString())->first();

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
