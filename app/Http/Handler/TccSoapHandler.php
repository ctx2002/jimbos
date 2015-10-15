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
        parent::__construct();
    }
    
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
        //data[email]
        //$data = $request->input(data);
        //$email = $data['email']
        //TODO: change email,at moment, it is hard coded
        $data = [
            'APIKey' => env('TCC_KEY', ''),
            'TCCNumber'   => env('TCC_NUMBER',''),
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
