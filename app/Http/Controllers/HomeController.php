<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;

use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=DB::table('posts')
            ->join('users','posts.user_id','=','users.id')
            ->select('posts.*','users.name','users.gender')
            ->where('users.gender',Auth::user()->gender)
            ->latest()->get() ;

        return view('home',compact(['posts',$posts]));
    }
}
