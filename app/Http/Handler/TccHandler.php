<?php

namespace  App\Http\Handler;
use Illuminate\Http\Request;
//use Artisaninweb\SoapWrapper\Facades\SoapWrapper;
use App\Http\Handler\TccSoapHandler;

class TccHandler
{
    
    public function handle(Request $request)
    {    
        $soap = new TccSoapHandler();
        return $soap->handle($request);
//        $obj = new \stdClass();
//        $obj->RequestResult = new \stdClass();
//        $obj->RequestResult->Description = "https://dev.coupond.com/sdjfaklsd000_998.pdf";
//        return $obj;
    }
}

