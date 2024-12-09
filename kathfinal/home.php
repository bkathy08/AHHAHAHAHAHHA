<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: index.php'); // Redirect to login if not logged in
    exit();
}

// Get user details from session
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCash - Home</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-logo">
            <img src="logo.png" alt="GCash Logo" class="logo-img">
        </div>
        <div class="navbar-links">
            <a href="profile.php" class="nav-link">Profile</a>
            <a href="logout.php" class="nav-link">Logout</a>
        </div>
    </nav>

    <!-- Main Container -->
    <main class="container">
        <h1>Welcome, <?php echo htmlspecialchars($user['firstname']); ?>!</h1>

        <!-- Balance Information -->
        <section class="balance-info">
            <h2>Your Balance</h2>
            <p class="balance">₱<?php echo number_format($user['balance'], 2); ?></p>
        </section>

        <!-- QR Code Section -->
        <section class="qr-code">
            <h2>Your QR Code</h2>
            <p>Scan this QR code to share your details.</p>
            <img src="qrcode.png" alt="QR Code" class="qr-img">
        </section>

        <!-- Actions Section -->
        <section class="actions">
            <div class="action-item">
                <a href="send_money.php" class="action-btn">Send Money</a>
            </div>
            <div class="action-item">
                <a href="pay_bills.php" class="action-btn">Pay Bills</a>
            </div>
            <div class="action-item">
                <a href="cash_in.php" class="action-btn">Cash In</a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>GCash &copy; <?php echo date('Y'); ?>. All rights reserved.</p>
    </footer>
</body>
</html>
