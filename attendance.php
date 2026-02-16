<?php
$host = "localhost";
$user = "root";
$password = "Password@123"; 
$database = "attendance_system";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Attendance Form</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f4f4f4; }
        form { background: #fff; padding: 20px; border-radius: 8px; width: 400px; margin: auto; }
        input, select { width: 100%; padding: 10px; margin: 10px 0; }
        button { padding: 10px 20px; background-color: #28a745; color: #fff; border: none; cursor: pointer; }
        button:hover { background-color: #218838; }
    </style>
</head>
<body>

<h2>Mark Attendance</h2>

<form action="insert_attendance.php" method="POST">
    <label>Select Student:</label>
    <select name="student_id" required>
        <option value="">-- Select Student --</option>
        <?php
        $result = $conn->query("SELECT id, name FROM students");
        while($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
        }
        ?>
    </select>

    <label>Lecture Number:</label>
    <input type="number" name="lecture_no" min="1" required>

    <label>Status:</label>
    <select name="status" required>
        <option value="">-- Select Status --</option>
        <option value="Present">Present</option>
        <option value="Absent">Absent</option>
    </select>

    <button type="submit">Submit Attendance</button>
</form>

</body>
</html>

<?php $conn->close(); ?>
