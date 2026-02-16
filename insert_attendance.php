<?php
require __DIR__ . '/vendor/autoload.php';  

use Twilio\Rest\Client;

$host = "localhost";
$user = "root";
$password = "Password@123"; 
$database = "attendance_system";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $lecture_no = $_POST['lecture_no'];
    $status = $_POST['status'];
    $today = date('Y-m-d');

    
    $sql = "INSERT INTO attendance (student_id, lecture_no, status, date) 
            VALUES ('$student_id', '$lecture_no', '$status', '$today')";

    if ($conn->query($sql) === TRUE) {
        echo "Attendance marked successfully.<br>";

        $student_result = $conn->query("SELECT name, whatsapp_number FROM students WHERE id='$student_id'");
        $student = $student_result->fetch_assoc();
        $student_name = $student['name'];
        $student_whatsapp = $student['whatsapp_number']; 

        $sid = getenv('TWILIO_SID');
        $token = getenv('TWILIO_TOKEN');
        
        $twilio = new Client($sid, $token);

        $from = 'whatsapp:+14155238886';  
        $to = 'whatsapp: '. $student_whatsapp;  
        $messageBody = "Hello $student_name! Your attendance for Lecture $lecture_no is marked as: $status.";

        
        try {
            $message = $twilio->messages->create($to, [
                'from' => $from,
                'body' => $messageBody
            ]);
            echo "WhatsApp Message sent successfully!";
        } catch (Exception $e) {
            echo "Failed to send WhatsApp: " . $e->getMessage();
        }
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
