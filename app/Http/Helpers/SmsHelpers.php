<?php
class SmsHelpers{

    public static function smsSend($mobile,$sms)
    {
        $API_KEY = '5db889d631b30';
        $SENDER_ID = "BLINKS";
        $RESPONSE_TYPE = 'json';

        $sms = urlencode($sms);
        
        $url = "https://app.rpsms.in/api/push.json?apikey=".$API_KEY."&sender=".$SENDER_ID."&mobileno=".$mobile."&text=".$sms."";
    //   dd($url);
        // Get cURL resource
        $ch = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => false,
        ));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        // Send the request & save response to $resp
        $resp =  curl_exec($ch);
        // Close request to clear up some resources
        curl_close($ch);
       return $resp;
    }
}