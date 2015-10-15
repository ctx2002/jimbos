<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Handler\MailChimpHandler;
use App\Coupon;
use Illuminate\Support\Facades\Redirect;

class CouponController extends Controller{
    
    public function index(Request $request) {
        
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
        $result = Coupon::where('client_id', '=', $id)->first();
        return Redirect::away($result->tcc_id);
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
            $handler = new MailChimpHandler();
            $handler->handle($request);
        });
    }
}