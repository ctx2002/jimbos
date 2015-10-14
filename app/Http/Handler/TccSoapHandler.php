<?php

namespace App\Http\Handler;
use Artisaninweb\SoapWrapper\Extension\SoapService;

use Illuminate\Http\Request;

class TccSoapHandler extends SoapService {
    
    /**
     * @var string
     */
    protected $wsdl = 'http://dev.couponcompany.co.nz/services/external.asmx?WSDL';
    
    /**
     * @var string
     */
    protected $name = 'jimbo';
    
    /**
     * @var boolean
     */
    protected $trace = true;
    
    /**
     * @var string
     * ***/
    protected $tccKey = "e7153da2-8c8d-4e69-a78e-219b835b7bd7";
    
    protected $tccNumber = 18249;
    
    public function functions()
    {
        return $this->getFunctions();
    }
    
    /**
     * 
     * ***/
    public function handle(Request $request)
    {
        
        $data = $this->extractSoapData($request);
        
        return $this->sendSoapRequest($data);
    }
    
    private function extracCode($result)
    {
        return $result->RequestResult->Code;    
    }
    
    private function extractSoapData(Request $request)
    {
        $data = [
            'APIKey' => $this->tccKey,
            'TCCNumber'   => $this->tccNumber,
            'EmailAddress'     => 'ctx2002@gmail.com'
        ];
        return $data;
    }
    
    private function sendSoapRequest($data)
    {
        $result = $this->call('request', [$data]);
        $code = $this->extracCode($result);
        if ($code > 199 && $code < 300) {//2xx
            return $result;        
        }
        abort($code);
    }
}
