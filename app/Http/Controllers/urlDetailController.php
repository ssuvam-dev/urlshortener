<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\shortUrl_model;
class urlDetailController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

	
    public function showUrlDetails(Request $request){
    	$search = $request->search;
        //condition to search the url..............
    	if($search == null){
    	$data['urls']=DB::table('short_url_models')->where('user_id',Auth::id())->simplePaginate(5);
    	$data['total']=DB::table('short_url_models')->where('user_id',Auth::id())->count();

    }
        // showing all the datas.........
    	else{
    		$data['urls']=DB::table('short_url_models')->where('user_id',Auth::id())->where('name','LIKE',"%$search%")->simplePaginate(5);
    	$data['total']=DB::table('short_url_models')->where('user_id',Auth::id())->where('name','LIKE',"%$search%")->count();
    	}
    	return view('frontend.urlList')->with($data);

    }
}
