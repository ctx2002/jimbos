<?php

namespace App\Http\Handler;
use Artisaninweb\SoapWrapper\Extension\SoapService;

use Illuminate\Http\Request;

class TccSoapHandler extends SoapService {
    
    /**
     * @var string
     */
    protected $name = 'jimbo';
    
    /**
     * @var boolean
     */
    protected $trace = true;
    
    public function __construct()
    {
        //TCC_WSDL stored in .env file
        $this->wsdl = env('TCC_WSDL', '');
        $this->options( array('http'=>array(
            'user_agent' => 'PHPSoapClient'
            )) );
        parent::__construct();
    }
    
    public function functions()
    {
        return $this->getFunctions();
    }
    
    public function handle(\App\Coupon $coupon)
    {
        $data = [
            'APIKey' => env('TCC_KEY', ''),
            'TCCNumber'   => env('TCC_NUMBER',''),
            'EmailAddress'     => $coupon->email,
            'FirstName' => $coupon->fname,
            'LastName'  => $coupon->lname
        ];
        
        return $this->sendSoapRequest($data);
    }
    
    /**
     * 
     * ***/
    /*public function handle(Request $request)
    {
        
        $data = $this->extractSoapData($request);
        
        return $this->sendSoapRequest($data);
    }*/
    
    public function getNewPetCoupon(\App\Coupon $coupon)
    {
        $data = [
            'APIKey' => env('TCC_KEY', ''),
            'TCCNumber'   => env('TCC_NUMBER',''),
            'EmailAddress'     => $coupon->email,
            'FirstName' => $coupon->fname,
            'LastName'  => $coupon->lname
        ];
        
        return $this->sendSoapRequest($data);
    }
    
    private function extracCode($result)
    {
        return $result->RequestResult->Code;    
    }
    
    private function extractSoapData(Request $request)
    {
        //data[email]
        $temp = $request->input('data');
        $data = [
            'APIKey' => env('TCC_KEY', ''),
            'TCCNumber'   => env('TCC_NUMBER',''),
            'EmailAddress'     => $temp['merges']['EMAIL'],
            'FirstName' => $temp['merges']['FNAME'],
            'LastName'  => $temp['merges']['LNAME']
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
