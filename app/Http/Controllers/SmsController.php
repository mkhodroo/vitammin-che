<?php

namespace App\Http\Controllers;

use Cryptommer\Smsir\Classes\Smsir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SmsController extends Controller
{
    public static function send($fields)
    {
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, 'https://api.sms.ir/v1/send/verify');
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_ENCODING, '');
      curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
      curl_setopt($curl, CURLOPT_TIMEOUT, 0);
      curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
      curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
      curl_setopt($curl,  CURLOPT_POSTFIELDS, "$fields");
      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Accept: text/plain',
        'x-api-key: zglBNfbqeGmlhJMpjaFDQv9FLXaHvX6JSFJiqOLoch6ilOeNCcWJEpQj9asUiKi1'
      ),);

      $response = curl_exec($curl);
      Log::info(curl_error($curl));

      curl_close($curl);
      return $response;
    }
    public function send_wellcome_sms($to, $name)
    {
        
        return $this->send(
            $to,
            302969,
            $name
        );
    }

    public static function new_order_to_admin($order_code){
        $to = '09376922176';
        $fields = '{
          "mobile": "'.$to.'",
          "templateId": 706302,
          "parameters": [
            {
              "name": "ORDER_CODE",
              "value": "'.$order_code.'"
            }
          ]
        }';
        return self::send($fields);
    }

    public static function order_validated($to, $order_code){
      $fields = '{
        "mobile": "'.$to.'",
        "templateId": 127105,
        "parameters": [
          {
            "name": "ORDER_CODE",
            "value": "'.$order_code.'"
          }
        ]
      }';
      return self::send($fields);
  }
}
