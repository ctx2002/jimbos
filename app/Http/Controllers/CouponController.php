<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Handler\MailChimpHandler;
use App\Http\Handler\TccHandler;

class CouponController extends Controller{
    
    public function index(Request $request) {
        
        //return "index";
        //return view("welcome");
        //pages/contact
        //return view("pages.contact");
        var_dump($request->input("name"));
        
        $handler = new MailChimpHandler();
        $handler->handle($request);
    }
    
    /**
     * Responds to requests to GET /coupon/show/8a25ff1d98
     * 
     * @paramter string $id a mail chimp id
     * ***/
    public function show($id)
    {
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // Any exception thrown within the transaction 
        // closure will cause the transaction to be rolled back automatically
        DB::transaction(function() use ($request)
        {
            //DB::table('users')->update(array('votes' => 1));

            //DB::table('posts')->delete();
            //TODO: call MailChimpHandler and save into db
            //TODO: call TccHandler and save into db
            $handler = new MailChimpHandler();
            $handler->handle($request);
        });
    }
}