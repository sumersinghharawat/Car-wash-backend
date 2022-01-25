<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendCustomerOtp extends Controller
{
    //
    public static function sendMessage($mobile, $message)
    {
        $apikey = "Z6pxnTPwVS5X2zQFiAdJBaOIMcRYytq87UGvD4ljub1Ls9ofgKmaGI7vXW2UuMCE4RY5q9nzLjSyfk6P";
        // $fields = array(
        //     "message" => $message,
        //     "language" => "english",
        //     "route" => "otp",
        //     "numbers" => $mobile,
        // );

        $fields = array(
            "variables_values" => $message,
            "route" => "otp",
            "numbers" => $mobile,
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_SSL_VERIFYHOST => 0,
          CURLOPT_SSL_VERIFYPEER => 0,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($fields),
          CURLOPT_HTTPHEADER => array(
            "authorization: ".$apikey,
            "accept: */*",
            "cache-control: no-cache",
            "content-type: application/json"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          return "cURL Error #:" . $err;
        } else {
          return $response;
        }
    }
}
