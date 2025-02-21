<?php
require_once '../vendor/autoload.php';
require '../Core/functions.php'; // Make sure you have the Twilio PHP SDK

use Twilio\Rest\Client;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $phone = filterRequest('phone');
    $otp = filterRequest('otp');

    if (!$phone || !$otp) {
        printFailure();
        exit();
    }

     $twilioSid = 'ACefdda3d43dae250c096ffed0ec0b32b0';
     $twilioToken = 'e3e6dd892b77d2f3ad15a832262e3d09';
     $twilioNumber = '+19133200933';
    $client = new Client($twilioSid, $twilioToken);

    try {
        $message = $client->messages->create(
            $phone,
            [
                'from' => $twilioNumber,
                'body' => "Your otp code is: $otp"
            ]
        );

        printSuccess();
    } catch (Exception $e) {
        printFailure();
    }
}



