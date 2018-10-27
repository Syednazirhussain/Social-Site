<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PayPalController extends Controller
{
    public function getAccessToken(){

    	$user_id 	=  "ASHI_zXg-aoMFI0DwB3YLfkqpeeCN5K-H0hfd-Ogy1K57lmL31Wdz2tIK0gHLEHVc21L4KAe57sweygd";
        $password   =  "EFMnSN68XtIrYenxVUXGwqxlrd_N2g_pnCVF8CCzlY049GrnlqdbdiLXIij4MESMpNb5N72JadWXUWGX";

        $data = [
          'Username'   => $user_id,
          'Password' 		=> $password
        ];

        // $data = [
        // 	'email'		=> 'syednazir13@gmail.com',
        // 	'password'	=> 'pakistan123'
        // ];

        $headers = [
        	'Accept: application/json',
        	'Accept-Language: en-US',
        	'ASHI_zXg-aoMFI0DwB3YLfkqpeeCN5K-H0hfd-Ogy1K57lmL31Wdz2tIK0gHLEHVc21L4KAe57sweygd:EFMnSN68XtIrYenxVUXGwqxlrd_N2g_pnCVF8CCzlY049GrnlqdbdiLXIij4MESMpNb5N72JadWXUWGX'
        ];

        $ch = curl_init('https://api.sandbox.paypal.com/v1/oauth2/token');
        curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        $response = curl_exec($ch);
        curl_close($ch);

        echo "<pre>";
        print_r($response);

        exit;die();


    }
}
