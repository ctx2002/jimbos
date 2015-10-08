<?php

namespace App\Http\Handler;
use Artisaninweb\SoapWrapper\Extension\SoapService;

class TccSoapHandler extends SoapService {
    
    /**
     * @var string
     */
    protected $wsdl = 'http://dev.couponcompany.co.nz/services/external.asmx?WSDL';
    
    public function functions()
    {
        return $this->getFunctions();
    }
}
