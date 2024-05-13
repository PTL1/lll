<?php
// Set database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "register_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $user_id = $_POST['user_id'];
    $new_status = $_POST['new_status'];

    // Prepare and bind update statement
    $stmt = $conn->prepare("UPDATE users SET user_status=? WHERE user_id=?");
    $stmt->bind_param("ii", $new_status, $user_id);

    // Execute update
    if ($stmt->execute()) {
        $message = "Update successful";
    } else {
        $message = "Update failed: " . $conn->error;
    }

    $stmt->close();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data Form</title>
</head>
<body>
    <?php if (isset($message)) echo "<p>$message</p>"; ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="user_id">User ID:</label>
        <input type="text" id="user_id" name="user_id" value="<?= isset($user_id) ? $user_id : '' ?>"><br><br>

        <label for="new_status">New Status:</label>
        <input type="number" id="new_status" name="new_status" value="<?= isset($new_status) ? $new_status : '' ?>"><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
