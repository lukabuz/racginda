<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Submission;
use App\Submission_reply;
use App\Vote;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class SubmissionsController extends Controller
{
    //
    public function show(Request $request, $id){
    	if(Submission::orderBy('created_at', 'desc')->take(40)->where('id', $id)->count() == 0){
    		abort(404);
    	}

    	$submission = Submission::findOrFail($id);

    	$replies = Submission_reply::where('submission_id', $id)->orderBy('created_at', 'ASC')->get();

    	return view('submission')->with('submission', $submission)->with('replies', $replies);
    }

    public function reply(Request $request, $id){
    	if(Submission::findOrFail($id)->where('created_at', '>=', Carbon::now()->subHours(72)->toDateTimeString())->count() == 0){
    		abort(404);
    	}

    	$parentsubmission = Submission::findOrFail($id);

    	$ip = $request->header('x-forwarded-for');

    	$ip = explode(",",$ip);

        $ip = $ip[0];

    	if(strlen($request->input('text')) > 3500){
    		return redirect()->back()->with('error', 'თქვენი პოსტი ძალიან გრძელია!');
    	}

        if(strlen($request->input('text')) < 2){
            return redirect()->back()->with('error', 'თქვენი პოსტი ძალიან მოკლეა!');
        }

    	$value = Cookie::get('userToken');

    	if($value){
    		if(Submission_reply::where('cookie', $value)->where('created_at', '>=', Carbon::now()->subMinutes(2)->toDateTimeString())->count() == 0){
    			$submission = new Submission_reply;

    			$submission->submission_id = $parentsubmission->id;
    			$submission->description = $request->input('text');
    			$submission->cookie = $value;
    			$submission->ip = $ip;
				$submission['user-agent'] = $request->header('User-Agent');
				
				if($request->hasFile('file')){
					$this->validate($request, [
						'file' => 'image|max:1999|required',
					]);

					$data = getimagesize($request->file('file'));
					$width = $data[0];
					$height = $data[1];

					if($width < 3840 && $height < 2160){
						$filenameWithExt = $request->file('file')->getClientOriginalName();

						$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

						$extension = $request->file('file')->getClientOriginalExtension();

						$filenameToStore = $filename.'_'.time().'.'.$extension;

						$request->file('file')->storeAs('photos', $filenameToStore, 's3', 'public');

						$submission->imageLink = $filenameToStore;
					} else {
						return redirect('/')->with('error', 'სურათი ძალიან დიდია!');
					}
				}

    			$submission->save();

    			return redirect()->back()->with('message', 'თქვენი პოსტი დამატებულია!');
    		} else {
    			return redirect()->back()->with('error', 'თქვენ ამის გაკეთება მხოლოდ 2 წუთში ერთხელ შეგიძლიათ');
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
				
				if($request->hasFile('file')){
					$this->validate($request, [
						'file' => 'image|max:1999|required',
					]);

					$data = getimagesize($request->file('file'));
					$width = $data[0];
					$height = $data[1];

					if($width < 3840 && $height < 2160){
						$filenameWithExt = $request->file('file')->getClientOriginalName();

						$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

						$extension = $request->file('file')->getClientOriginalExtension();

						$filenameToStore = $filename.'_'.time().'.'.$extension;

						$request->file('file')->storeAs('photos', $filenameToStore, 's3', 'public');

						$submission->imageLink = $filenameToStore;
					} else {
						return redirect('/')->with('error', 'სურათი ძალიან დიდია!');
					}
				}

    			$submission->save();

	    		return redirect()->back()->with('message', 'თქვენი პოსტი დამატებულია!')->withCookie(Cookie::forever('userToken', $token));
	    	} else {
	    		return redirect()->back()->with('error', 'თქვენ ამის გაკეთება მხოლოდ 2 წუთში ერთხელ შეგიძლიათ');
	    	}
    	}
    }
}
