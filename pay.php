<?php

// PayPal Classic API Credentials
$paypal_username = "sb-rxih849765328_api1.business.example.com";
$paypal_password = "J4PKWPGKE4XJJD66";
$paypal_signature = "AEiVfkkprk5.RXAwuW6zXqeHVHnVAmVVDfSlWLYdPMEdL1Wm.p2mwTjM";

$paypal_url = "https://api-3t.sandbox.paypal.com/nvp";
$paypal_redirect = "https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=";


// Get POST values safely
$employees = $_POST['employees'] ?? [];
$amount = $_POST['amount'] ?? 0;

$total_employees = count($employees);
$total_amount = $amount * $total_employees;


// NVP Request
$nvp = array(
    'METHOD' => 'SetExpressCheckout',
    'VERSION' => '124',
    'USER' => $paypal_username,
    'PWD' => $paypal_password,
    'SIGNATURE' => $paypal_signature,

    'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale',
    'PAYMENTREQUEST_0_AMT' => $total_amount,
    'PAYMENTREQUEST_0_CURRENCYCODE' => 'USD',

    'PAYMENTREQUEST_0_ITEMAMT' => $total_amount,

    'L_PAYMENTREQUEST_0_NAME0' => 'Employee Registration',
    'L_PAYMENTREQUEST_0_AMT0' => $amount,
    'L_PAYMENTREQUEST_0_QTY0' => $total_employees,

    'RETURNURL' => 'http://localhost/tchr/success.php',
    'CANCELURL' => 'http://localhost/tchr/cancel.php'
);
$nvp_string = http_build_query($nvp);


// cURL
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $paypal_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $nvp_string);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);


// Check curl error
if(curl_errno($ch)){
    echo "cURL Error: " . curl_error($ch);
    exit;
}

curl_close($ch);



// Convert response to array
parse_str($response, $result);


// Check ACK safely
if(isset($result['ACK']) && $result['ACK'] == 'Success'){

    $token = $result['TOKEN'];

    header("Location: ".$paypal_redirect.$token);
    exit;

}else{

    echo "<h3>PayPal API Error</h3>";
    print_r($result);

}

?>