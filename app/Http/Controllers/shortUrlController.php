<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\shortUrl_model;
class shortUrlController extends Controller
{
    //function to create a short url.................
	public function shortUrlConverter(){
		$short_url=base_convert(rand(10000,99999),10,36);
		$data=shortUrl_model::where('short_url',$short_url)->first();
		if($data){
			$this->shortUrlConverter();
		}
		return $short_url;
	}



    //function to get data from a form and save it in the database......
    public function createShortUrl(Request $request){
    		$request->validate([
    			'original_url'=>'url',
    		]);
            // checking if url exists in database system ....
    		$url=shortUrl_model::where('original_url',$request->original_url)->first();
    		if($url){
                // .....checking if url exists in user databse system....
                $user_url =shortUrl_model::where('original_url',$request->original_url)->where('user_id',Auth::id())->first(); 
                if(Auth::check()){
                        if(!$user_url){
                            //.........saving that url to the user............
                            $user_url=new shortUrl_model();
                            $user_url->original_url=$request->original_url;
                            $user_url->short_url=$url->short_url;
                            $user_url->user_id=Auth::id();
                            $user_url->name=$request->url_name;
                            $user_url->save(); 

                            //checking if the url is linked with user or not............
                            $url=shortUrl_model::where('user_id',null)->first(); 
                            if($url){
                                $url->delete();
                            }  // end of deleteing user....
                        }// end of checking user...

                    return redirect()->back()->with('message',
                    'URL is : <a href="'.url($user_url->short_url).'">'.url($user_url->short_url).'</a>');
                }// end of checking auth
                return redirect()->back()->with('message',
                    'URL is : <a href="'.url($url->short_url).'">'.url($url->short_url).'</a>');
            }
	    	
           
            //adding the  new short url to the databse...................
    		else{
	    		$url=new shortUrl_model();
	    		$url->original_url=$request->original_url;
	    		$url->short_url=$this->shortUrlConverter();
                if(Auth::check()){
                    $url->user_id=Auth::id();
                    $url->name=$request->url_name;
                }
	    		$url->save();
	    		return redirect()->back()->with('message',
                    'URL is : <a href="'.url($url->short_url).'">'.url($url->short_url).'</a>'
            );
    		}
    		
    }		


    // function to redirect the short url to its original url............
    public function shortUrl($short_url){
    	$url = shortUrl_model::whereShort_url($short_url)->first();
    
    	if($url){
    		return redirect(url($url->original_url));
    	}
    	else{
    		return redirect()->back();
    	}
    }

    // function to delete the url permanently from the databse..................
    public function deleteUrl($id){
        $url=shortUrl_model::find($id);
        $url->delete();
        return redirect()->route('url.details')->with('message',"URL Deleted Successfully");
    }



}
