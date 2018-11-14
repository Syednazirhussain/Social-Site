<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalController extends Controller
{

    public function subcribe()
    {
        $provider = new ExpressCheckout;

        $options = [
            'BRANDNAME' => 'Creatifny',
            'LOGOIMG' => "{{ asset('/theme/images/logo1.png') }}",
            'CHANNELTYPE' => 'Merchant'
        ];



        $startdate = \Carbon\Carbon::now()->toAtomString();
        $profile_desc = !empty($data['subscription_desc']) ?
                    $data['subscription_desc'] : "Subcription charges are 90$ per/month will be charge accordingly";
        $data = [
            'PROFILESTARTDATE' => $startdate,
            'DESC' => $profile_desc,
            'BILLINGPERIOD' => 'Month', // Can be 'Day', 'Week', 'SemiMonth', 'Month', 'Year'
            'BILLINGFREQUENCY' => 1, // 
            'AMT' => 10, // Billing amount for each billing cycle
            'CURRENCYCODE' => 'USD', // Currency code 
            'TRIALBILLINGPERIOD' => 'Day',  // (Optional) Can be 'Day', 'Week', 'SemiMonth', 'Month', 'Year'
            'TRIALBILLINGFREQUENCY' => 10, // (Optional) set 12 for monthly, 52 for yearly 
            'TRIALTOTALBILLINGCYCLES' => 1, // (Optional) Change it accordingly
            'TRIALAMT' => 0, // (Optional) Change it accordingly
        ];

        $data['items'] = [
            [
                'name' => 'Subcription',
                'price' => 90.00
            ]
        ];
        $data['invoice_description'] = 'Invoice description';
        $data['invoice_id'] = 91;
        $data['return_url'] = route('user.membership.payment');
        $data['cancel_url'] = route('user.membership.payment');
        $data['total'] = 90.00;


        $response = $provider->addOptions($options)->setExpressCheckout($data);


        // Use the following line when creating recurring payment profiles (subscriptions)
        //$response = $provider->setExpressCheckout($data, true);


        return redirect($response['paypal_link']);



    }



    public function getAccessToken()
    {

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
