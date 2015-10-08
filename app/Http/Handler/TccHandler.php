<?php

namespace  App\Http\Handler;
use Illuminate\Http\Request;
use App\MailChimp;

class TccHandler
{
    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    /***
     * @return int returns a mail_chimp table record id.
     * **/
    public function save(MailChimp $mailChimp)
    {
        
    }
}

