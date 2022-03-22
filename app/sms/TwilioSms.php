<?php

use Twilio\Rest\Client;

class TwilioSms implements SmsInterface
{
    public function Send(string $phoneno,string $message)
    {
        // Your Account $10 and Auth Token from twilio.com/console
        $sid = 'ACXXXXXXXXXXXXXXXXXXXXXX';
        $token = 'your_auth_token';
        $client = new Client($sid, $token);

        // Use the client to do fun stuff like send text message
        $client->messages->create(
            // the number your'd like to send the message to
            $phoneNumber,
            [
                // A Twilio phone number you purchased at twilio.com/console
                'from' => '+15017250404',
                // the body of the text message you'd like to send
                'body' => $message
            ]
        );
    }

    public function MobileSms($mobileno)
    {
        $otp = random_int(100000, 999999);
        $username = "pramod.gupta@daakexpress.co.in";
        $password = "PkSk$4100";


        //Send by Class
        $numbers = "91". $mobileno;
        
        // SMS BY POST METHOD
        $apiKey = urlencode('6jsVmB+jG7k-v3URJ4r4i8LiYCPDGodtwACAnybQdU');

        $sender = urlencode('TXTLCL');
        $message = rawurlencode('Your One Time Password is ' . $otp);

        $message = rawurlencode('Welcome in Daak Express. We comes with new Approach in logistics.

Pramod Gupta.');


$message = rawurlencode('Welcome to DAAK Express . Your OTP for mobile verification '.$otp.'

Thanks 
DAAK Express');

        // Prepare data for POST request
        $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
        
        // Send the POST request with cURL
        try{
            // header('Access-Control-Allow-Origin: *');
            // header('Content-Type: Application/Json');
            // header('Access-Control-Allow-Method: POST');

            $ch = curl_init('https://api.textlocal.in/send/');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            $jsondecode = json_decode($response);
            //if($jsondecode['status'] != 'success'){
                return response(['message' => $jsondecode]);
            //}
        }catch(\Exception $ex){
            return response(['message' => $ex->getMessage()]);
        }
    }
}