<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ZarinpalController extends Controller
{
    public static function get_authority(int $amount, string $des = 'خرید آنلاین', array $data = [])
    {
        $data = array(
            "merchant_id" => config('payment.zarinpal.merchantID'),
            "amount" => $amount,
            "callback_url" => route('verify-online-pay', [ 'amount' => $amount ]),
            "description" => $des,
            "metadata" => $data,
            );
        $jsonData = json_encode($data);
        $ch = curl_init('https://api.zarinpal.com/pg/v4/payment/request.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));

        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true, JSON_PRETTY_PRINT);
        curl_close($ch);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            if (empty($result['errors'])) {
                if ($result['data']['code'] == 100) {
                    return $result['data']["authority"];
                }
            } else {
                echo'Error Code: ' . $result['errors']['code'];
                echo'message: ' .  $result['errors']['message'];

            }
        }
    }

    public static function go_to_pay($payment_authority)
    {
        return 'https://www.zarinpal.com/pg/StartPay/' . $payment_authority;
    }

    public static function verify(int $amount)
    {
        $Authority = $_GET['Authority'];
        $data = array(
            "merchant_id" => config('payment.zarinpal.merchantID'), 
            "authority" => $Authority, 
            "amount" => $amount
        );
        $jsonData = json_encode($data);
        $ch = curl_init('https://api.zarinpal.com/pg/v4/payment/verify.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v4');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));

        $err = curl_error($ch);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, true);

        if ($err) {
            return [
                'success' => 0,
                'authority' => $Authority,
            ];
        } else {
            if (isset($result['data']['code']) && $result['data']['code'] == 100) {
                return [
                    'success' => 1,
                    'refID' => $result['data']['ref_id'],
                    'authority' => $Authority
                ];
            } else {
                // echo'code: ' . $result['errors']['code'];
                // echo'message: ' .  $result['errors']['message'];
                return [
                    'success' => 0,
                    'authority' => $Authority,
                    'description' => $result['errors']['message']
                ];
            }
        }
    }
}
