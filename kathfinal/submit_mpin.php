<?php
session_start();

// Include the database connection file
include('database/connection.php');

// Check if the user is already logged in (session should have phone_number)
if (!isset($_SESSION['phone_number'])) {
    header('Location: index.php'); // Redirect to login page if not logged in
    exit();
}

// Get the phone number from the session
$phone_number = $_SESSION['phone_number'];

// If the form is submitted (when user enters MPIN)
if (isset($_POST['mpin'])) {
    // Sanitize the MPIN input to prevent SQL injection
    $mpin = $conn->real_escape_string($_POST['mpin']);

    // Query to check if the MPIN matches the one in the database for the logged-in user
    $sql = "SELECT * FROM users WHERE phone_number='$phone_number' AND mpin='$mpin'";
    $result = $conn->query($sql);

    // If the query returns a matching user
    if ($result->num_rows > 0) {
        // Set session variable for user role and other details if necessary
        $row = $result->fetch_assoc();
        $_SESSION['user'] = $row;  // Store user info in session

        // Redirect to home.php after successful MPIN validation
        header("Location: HOME.php");
        exit();  // Ensure no further code is executed after the redirect
    } else {
        // If the MPIN is incorrect, display an error message
        $error_message = "Invalid MPIN. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter MPIN</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Enter Your MPIN</h2>

        <!-- Display error message if it exists -->
        <?php if (isset($error_message)): ?>
            <div class="error-message text-red-500">
                <p><?php echo $error_message; ?></p>
            </div>
        <?php endif; ?>

        <!-- Form to input MPIN -->
        <form action="submit_mpin.php" method="post">
            <div class="form-group">
                <input type="password" name="mpin" placeholder="Enter MPIN" required aria-label="MPIN" maxlength="4">
            </div>
            
            <!-- Submit button -->
            <button type="submit" class="btn">Submit</button>
        </form>
    </div>
</body>
</html>
