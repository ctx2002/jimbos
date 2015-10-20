<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Handler\MailChimpHandler;
use Illuminate\Support\Facades\Redirect;
use App\Http\Handler\CouponHandler;
use DB;

class CouponController extends Controller{
    
    public function index(Request $request)
    {
        DB::transaction(function() use ($request)
        {
            $handler = new MailChimpHandler();
            $coupon = \App\Coupon::loadCoupon($request);
            $handler->handle($coupon, $request->input('type'));
        });
    }
    
    /**
     * Responds to requests to GET /coupon/show/8a25ff1d98
     * 
     * @paramter string $id a mail chimp id
     * @paramter string $campaignId a mail chimp compaign id
     * ***/
    public function show($id,$campaignId)
    {           
        $handler = new CouponHandler();
        $coupon = $handler->show($id,$campaignId);
        return Redirect::away($coupon->tcc_id);
    }
    
    public function pet($id, $campaignId, $dob)
    {
        $handler = new CouponHandler();
        $coupon = $handler->pet($id, $campaignId, $dob);
        if ($coupon) {
            return Redirect::away($coupon->tcc_id);
        }
        
        abort(404);
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
            $coupon = \App\Coupon::loadCoupon($request);
            $handler->handle($coupon, $request->input('type'));
        });
    }
}