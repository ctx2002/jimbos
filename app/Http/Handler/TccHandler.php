<?php

namespace  App\Http\Handler;
//use Illuminate\Http\Request;
//use Artisaninweb\SoapWrapper\Facades\SoapWrapper;
use App\Http\Handler\TccSoapHandler;
//use App\Coupon;

class TccHandler
{
    
    public function handle(\App\Coupon $coupon)
    {    
        $soap = new TccSoapHandler();
        return $soap->handle($coupon);
//        $obj = new \stdClass();
//        $obj->RequestResult = new \stdClass();
//        $obj->RequestResult->Description = "https://dev.coupond.com/sdjfaklsd000_998.pdf";
//        return $obj;
    }
    
    /*public function getNewPetCoupon(\App\Coupon $coupon)
    {
        $soap = new TccSoapHandler();
        return $soap->getNewPetCoupon($coupon);
    }*/
}

