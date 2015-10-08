<?php
namespace  App\Http\Handler;
use Illuminate\Http\Request;
use Artisaninweb\SoapWrapper\Facades\SoapWrapper;

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
        
        //TODO: send request to TCC, if API is wrong
        //      it returns 401.
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
    }
}

