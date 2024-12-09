<?php
// Include the connection file
include('db/connection.php');

// Check if the user is redirected from the registration page
if (isset($_GET['message_success'])) {
    $success_message = htmlspecialchars($_GET['message_success']);
} else {
    $success_message = "Please log in to continue.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gcash.css">
    <title>GCash - Account Setup</title>
</head>
<body>
    <div class="container">
        <h2>Welcome to GCash</h2>

        <?php if (isset($success_message)): ?>
            <div class="success-message">
                <p><?php echo $success_message; ?></p>
            </div>
        <?php endif; ?>

        <form action="mpin.php" method="post">
            <div class="form-group">
                <label for="mobile">Enter your Mobile Number (+63):</label>
                <input type="text" name="mobile" id="mobile" required placeholder="Enter your mobile number">
            </div>

            <button type="submit">Next</button>
        </form>
        
        <div class="back-link">
            <a href="index.php">Back to Login</a>
        </div>
    </div>
</body>
</html>
