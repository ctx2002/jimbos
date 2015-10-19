<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Handler\MailChimpHandler;
use Illuminate\Support\Facades\Redirect;
use App\Http\Handler\CouponHandler;

class CouponController extends Controller{
    
    public function index(Request $request) {
        $handler = new MailChimpHandler();
        $handler->handle($request);
    }
    
    /**
     * Responds to requests to GET /coupon/show/8a25ff1d98
     * 
     * @paramter string $id a mail chimp id
     * @paramter string $listId a mail chimp list id
     * ***/
    public function show($id,$listId,$campaignId)
    {           
        $handler = new CouponHandler();
        $coupon = $handler->show($id, $listId, $campaignId);
        return Redirect::away($coupon->tcc_id);
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