<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>Registration Form</title>
</head>
<body>
    <div class="container">
        <h2>Registration Form</h2>

        <!-- Display error message if set -->
        <span class="error-message">
            <?php
                if (isset($_GET['message'])) {
                    echo htmlspecialchars($_GET['message'], ENT_QUOTES, 'UTF-8'); // Sanitized output to prevent XSS
                }
            ?>
        </span>

        <form action="register_account.php" method="post"> <!-- Updated form action -->
            <div class="form-group">
                <input type="text" name="firstname" placeholder="Enter Firstname" required aria-label="Firstname">
            </div>

            <div class="form-group">
                <input type="text" name="lastname" placeholder="Enter Lastname" required aria-label="Lastname">
            </div>

            <div class="form-group">
                <input type="text" name="phone_number" placeholder="Enter Phone Number" required aria-label="Phone Number">
            </div>

            <div class="form-group">
                <input type="email" name="email" placeholder="Enter Email" required aria-label="Email">
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Enter Password" required aria-label="Password">
            </div>

            <!-- MPIN field -->
            <div class="form-group">
                <input type="password" name="mpin" placeholder="Enter MPIN" required aria-label="MPIN">
            </div>

            <!-- Role selection (Client or Admin) -->
            <div class="form-group">
                <label for="role">Select Role:</label>
                <select name="role" id="role" required aria-label="Role">
                    <option value="client">Client</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <input type="submit" value="Register"> 
        </form>

        <div class="back-link">
            <a href="index.php">Back to Login</a>
        </div>
    </div>
</body>
</html>
