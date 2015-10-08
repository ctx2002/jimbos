<?php
namespace  App\Http\Handler;
use Illuminate\Http\Request;

class MailChimpHandler {
    
    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    /***
     * @return App\MailChimp returns a MailChimp model.
     * **/
    public function subscribes()
    {
       
    }
}

