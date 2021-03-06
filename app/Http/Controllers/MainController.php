<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Submission;
use App\Vote;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    //
    public function index(Request $request){
    	if($request->get('sort') == 'new'){
    		return view('main')->with('submissions', Submission::orderBy('created_at', 'desc')->take(40)->get());
    	}

    	$submissions = Submission::orderBy('created_at', 'desc')->take(40)->get();

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

    	if(strlen($request->input('text')) > 3500){
    		return redirect('/')->with('error', 'თქვენი პოსტი ძალიან გრძელია!');
    	}

        if(strlen($request->input('text')) < 2){
            return redirect('/')->with('error', 'თქვენი პოსტი ძალიან მოკლეა!');
        }

    	$value = Cookie::get('userToken');

    	if($value){
    		if(Submission::where('cookie', $value)->where('created_at', '>=', Carbon::now()->subMinutes(2)->toDateTimeString())->count() == 0){
    			$submission = new Submission;

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

    			return redirect('/?sort=new')->with('message', 'თქვენი პოსტი დამატებულია!');
    		} else {
    			return redirect('/')->with('error', 'თქვენ ამის გაკეთება მხოლოდ 2 წუთში ერთხელ შეგიძლიათ');
    		}
    	} else {
    		if(Submission::where('user-agent', $request->header('User-Agent'))->where('ip', $ip)->where('created_at', '>=', Carbon::now()->subMinutes(2)->toDateTimeString())->count() == 0){
	    		
	    		$token = str_random(40);

	    		$submission = new Submission;

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

	    		return redirect('/')->with('message', 'თქვენი პოსტი დამატებულია!')->withCookie(Cookie::forever('userToken', $token));
	    	} else {
	    		return redirect('/')->with('error', 'თქვენ ამის გაკეთება მხოლოდ 2 წუთში ერთხელ შეგიძლიათ');
	    	}
    	}
    }

    public function upvote(Request $request, $id){
		$submission = Submission::findOrFail($id);
		
		return $submission->upvote();
    }

    public function downvote(Request $request, $id){
    	$submission = Submission::findOrFail($id);

    	return $submission->downvote();
    }
}
