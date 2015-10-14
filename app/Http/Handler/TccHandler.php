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
    }
    
    /***
     * @return int returns a tcc_id
     * **/
    public function soapPost()
    {
        /**
         * <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
                <soap:Body>
                   <RequestResponse xmlns="http://request.couponcompany.co.nz/">
                      <RequestResult>
                         <Code>401</Code>
                         <Description>Invalid data.</Description>
                         <ValidationFailures/>
                      </RequestResult>
                   </RequestResponse>
                </soap:Body>
             </soap:Envelope>
         * ***/  
        $soap = new TccSoapHandler();
        
        //no email, return 400
        
//        <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
//        <soap:Body>
//        <RequestResponse xmlns="http://request.couponcompany.co.nz/">
//         <RequestResult>
//            <Code>400</Code>
//            <Description>The field EmailAddress is either not specified or is invalid.</Description>
//            <ValidationFailures/>
//         </RequestResult>
//        </RequestResponse>
//        </soap:Body>
//        </soap:Envelope>
        
        
    }
}

