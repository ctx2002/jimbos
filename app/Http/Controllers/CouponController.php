<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Handler\MailChimpHandler;
use App\Http\Handler\TccHandler;

class CouponController extends Controller{
    
    /*public function index(Request $request) {
        
        //return "index";
        //return view("welcome");
        //pages/contact
        //return view("pages.contact");
        var_dump($request->input("name"));
    }*/
    
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //TODO: I have build a handler;
        DB::transaction(function()
        {
            //DB::table('users')->update(array('votes' => 1));

            //DB::table('posts')->delete();
            //TODO: call MailChimpHandler and save into db
            //TODO: call TccHandler and save into db
        });
    }
}