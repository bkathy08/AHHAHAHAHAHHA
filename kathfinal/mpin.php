<?php
// Save this file as "mpin.php"
session_start();

// Ensure the mobile number is passed correctly, either from session or POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mobile = $_POST['mobile'] ?? null;

    // Store mobile number in session for subsequent requests
    if ($mobile) {
        $_SESSION['mobile'] = $mobile;
    }
}

// Retrieve mobile number from session
$mobile = $_SESSION['mobile'] ?? null;

// Redirect to the main page if no mobile number is available
if (!$mobile) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Create MPIN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-500 flex flex-col items-center justify-center min-h-screen text-white">
    <div class="text-center">
        <h1 class="text-3xl font-bold mb-6">Set Your MPIN</h1>
        <p class="mb-4">Mobile Number: <strong>+63 <?php echo htmlspecialchars($mobile); ?></strong></p>
        <form action="submit_mpin.php" method="post">
            <!-- Hidden field to pass mobile number -->
            <input type="hidden" name="mobile" value="<?php echo htmlspecialchars($mobile); ?>">

            <!-- MPIN input -->
            <input name="mpin" type="password" 
                   class="bg-transparent border-b-2 border-white text-2xl text-center outline-none tracking-widest w-20" 
                   maxlength="4" placeholder="****" required />
            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-full hover:bg-blue-600">
                    Submit
                </button>
            </div>
        </form>
    </div>
</body>
</html>
