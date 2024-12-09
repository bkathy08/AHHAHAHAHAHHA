<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <style>
    
    
    body 
    {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      height: 100vh;
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: red;
    }
    

    .navbar {
      width: 100%;
      background-color: #4caf50;
      overflow: hidden;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 1000;
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo {
      float: left;
      display: block;
      padding: 0 20px;
    }

    .logo img {
      border-radius: 50%;
      width: 50px;  
      height: auto;
    }

    .search-container {
      margin-right: 870px;
      display: flex;
    }

    .search-bar-wrapper {
      position: relative;
      width: 50%;
    }

    .search-bar {
      width: 100%;
      padding: 10px;
      padding-right: 35px;
      border-radius: 4px;
      border: 1px solid #ddd;
      font-size: 14px;
      outline: none;
    }

    .search-bar::placeholder {
      color: #888;
    }

    .search-icon {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      color: #888;
    }

    .container {
      max-width: 300px;
      padding: 50px;
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      text-align: center;
      margin-top: 80px;
    }

    .login-title {
      font-size: 30px;
      color: #333;
      font-weight: bold;
      margin-bottom: 20px;
    }

    h2 {
      margin-bottom: 20px;
      color: #333;
    }

    input[type="text"],
    input[type="password"] {
      width: 200px;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
    }

    input[type="submit"] {
      width: 200px;
      padding: 10px;
      background-color: #4CAF50;
      color: #ffffff;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .error-message {
      color: red;
      font-size: 12px;
      font-style: italic;
      margin-bottom: 10px;
    }

    .register-link {
      display: block;
      margin-top: 15px;
      color: #4CAF50;
      text-decoration: none;
    }

    .register-link:hover {
      color: #388e3c;
    }

  </style>
</head>
<body>
  <div class="navbar">
    <div class="logo">
      <a href="index.php"><img src="img/kt.png" alt="Logo"></a> 
    </div>

    <div class="search-container">
      <div class="search-bar-wrapper">
        <form action="" method="get" style="position: relative; width: 100%;">
          <input type="text" class="search-bar" placeholder="Search..." name="search">
        </form>
      </div>
    </div>
  </div>

  <p class="login-title">Balance Buzz</p>

  <div class="container">
    <h2>Login</h2>
    <?php if(isset($_GET['incorrect'])): ?>
      <span class="error-message">Incorrect Username or Password!</span>
    <?php endif; ?>
    <form action="authenticate.php" method="post">
      <input type="text" name="username" placeholder="Enter Username" required>
      <input type="password" name="password" placeholder="Enter Password" required>
      <input type="submit" value="Login" name="login">
    </form>
    <a href="register.php" class="register-link">Create an account</a>
  </div>
</body>
</html>
