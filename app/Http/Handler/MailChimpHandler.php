<?php
namespace  App\Http\Handler;
use Illuminate\Http\Request;
use App\Http\Handler\TccHandler;

class MailChimpHandler {
    
    public function __construct()
    {
    }
    
    public function handle(Request $request)
    {    
        $name = $request->input('type');
        if ('subscribe' == $name) {
            $this->subscribes($request);
        }
    }
    
    /***
     * @return App\MailChimp returns a MailChimp model.
     * **/
    protected function subscribes(Request $request)
    {
        //those should be fetched from $this->request object
        /**
         * "type": "subscribe", 
            "fired_at": "2009-03-26 21:35:57", 
            "data[id]": "8a25ff1d98", 
            "data[list_id]": "a6b5da1054",
            "data[email]": "api@mailchimp.com", 
            "data[email_type]": "html", 
            "data[merges][EMAIL]": "api@mailchimp.com", 
            "data[merges][FNAME]": "MailChimp", 
            "data[merges][LNAME]": "API", 
            "data[merges][INTERESTS]": "Group1,Group2", 
            "data[ip_opt]": "10.20.10.30", 
            "data[ip_signup]": "10.20.10.30"
         * 
         * **/
        
        //$table->string('mail_chimp_data_id', 10);
        //$table->string('mail_chimp_list_id', 10);
        //TODO: get id and list_id
        $tccHandler = new TccHandler();
        $tcc = $tccHandler->handle($request);
        //TODO: exract tcc id
        //at moment it returns following soap message.
        /**
         * <soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
   <soap:Body>
      <RequestResponse xmlns="http://request.couponcompany.co.nz/">
         <RequestResult>
            <Code>201</Code>
            <Description>http://dev.couponcompany.co.nz/coupon/ef4f93b4-d155-44b3-ac17-5b17992ca892.pdf</Description>
            <ValidationFailures/>
         </RequestResult>
      </RequestResponse>
   </soap:Body>
</soap:Envelope>
         * ****/
        
    }
}

