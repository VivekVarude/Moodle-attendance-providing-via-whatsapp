<?php
require __DIR__ . '/vendor/autoload.php';

use Twilio\Rest\Client;


$sid = getenv('TWILIO_SID');
$token = getenv('TWILIO_TOKEN');
$twilio = new Client($sid, $token);


$to = 'whatsapp:+919356730587';  
$from = 'whatsapp:+17126316181'; 


$messageBody = "Hello ! This is your attendance report:\nLecture 1: Present\nLecture 2: Absent";


$message = $twilio->messages
                  ->create($to, 
                           [
                               "from" => $from,
                               "body" => $messageBody
                           ]
                  );

echo "Message sent! SID: " . $message->sid;
?>
