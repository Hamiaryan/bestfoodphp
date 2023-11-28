<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Login</title>
    <?php include '../Home.php'; ?>
    
  
    
</head>

<div class="login">
  <h1>Admin Dashboard</h1>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <input type="submit" value="Login">
        <p> User Login <a href="../Buyer/buyer_login_form.php">Here</a>
    </form>

</div>

</body>

</html>


<?php
    session_start(); // Start or resume a session

    require '../db.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Perform admin login verification (you may use session for authentication)

        // Example: Check if the admin exists in the 'admins' table
        $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
            if (password_verify($password, $admin['password'])) {
                // Admin login successful
                // Set a session variable for admin authentication
                $_SESSION['admin_username'] = $admin['username'];
                $_SESSION['admin_name'] = $admin['name']; // Assuming there's a 'name' column in your 'admins' table

                // Redirect to the next page
                header("Location: admin_dashboard.php");
                exit(); // Ensure that the script stops here to prevent further execution
            } else {
                echo "Invalid password";
            }
        } else {
            echo "";
        }

        $stmt->close();
    }

    $conn->close();
    ?>
</body>

<?php include '../include/global_footer.php'; ?>
</html>
<style>
/*
 * Copyright (c) 2012 Thibaut Courouble
 * http://www.cssflow.com
 * Licensed under the MIT License
 *
 * Sass/SCSS source: https://goo.gl/0jzXf
 * PSD by Orman Clark: https://goo.gl/D8zmk
 */

body {
  
  background-image: url('http://localhost:8080/bestfood/asset/back2.jpg');
  background-size: cover; /* This will contain the image within the container while maintaining aspect ratio */
  background-repeat: no-repeat;
}

.login {
  position: relative;
  margin: 30px auto;
  padding: 20px 20px 20px;
  width: 310px;
  background: white;
  border-radius: 3px;
  -webkit-box-shadow: 0 0 200px rgba(255, 255, 255, 0.5), 0 1px 2px rgba(0, 0, 0, 0.3);
  box-shadow: 0 0 200px rgba(255, 255, 255, 0.5), 0 1px 2px rgba(0, 0, 0, 0.3);
  background: linear-gradient( 135deg, #fff 1%, #fd5e086b 100%);
}

.login:before {
  content: '';
  position: absolute;
  top: -8px;
  right: -8px;
  bottom: -8px;
  left: -8px;
  z-index: -1;
  
  border-radius: 4px;
  background: linear-gradient( 135deg, #fff 1%, #8000 100%);
}

.login h1 {
  margin: -20px -20px 21px;
  line-height: 40px;
  font-size: 15px;
  font-weight: bold;
  color: #555;
  text-align: center;
  text-shadow: 0 1px white;
  background: #f3f3f3;
  border-bottom: 1px solid #cfcfcf;
  border-radius: 3px 3px 0 0;
 
  -webkit-box-shadow: 0 1px whitesmoke;
  box-shadow: 0 1px whitesmoke;
  background: linear-gradient( 135deg, #fff 1%, #fd5e086b 100%);
}

.login p {
  margin: 20px 0 0;
}

.login p:first-child {
  margin-top: 0;
}

.login input[type=text], .login input[type=password] {
  width: 278px;
}

.login p.remember_me {
  float: left;
  line-height: 31px;
}

.login p.remember_me label {
  font-size: 12px;
  color: #777;
  cursor: pointer;
}

.login p.remember_me input {
  position: relative;
  bottom: 1px;
  margin-right: 4px;
  vertical-align: middle;
}

.login p.submit {
  text-align: right;
}

.login-help {
  margin: 20px 0;
  font-size: 11px;

  text-align: center;
  text-shadow: 0 1px #2a85a1;
}

.login-help a {
  color: #cce7fa;
  text-decoration: none;
}

.login-help a:hover {
  text-decoration: underline;
}

:-moz-placeholder {
  color: #c9c9c9 !important;
  font-size: 13px;
  
}

::-webkit-input-placeholder {
  color: #ccc;
  font-size: 13px;

}

input {
  font-family: 'Lucida Grande', Tahoma, Verdana, sans-serif;
  font-size: 14px;
}

input[type=text], input[type=password] {
  margin: 5px;
  padding: 0 10px;
  width: 200px;
  height: 34px;
  color: #404040;
  background: white;
  border: 1px solid;
  border-color: #c4c4c4 #d1d1d1 #d4d4d4;
  border-radius: 2px;
  outline: 5px solid #eff4f7;
  -moz-outline-radius: 3px;
  -webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);
  box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);
}

input[type=text]:focus, input[type=password]:focus {
  border-color: #7dc9e2;
  outline-color: #dceefc;
  outline-offset: 0;
}

input[type=submit] {
  padding: 0 18px;
  height: 29px;
  font-size: 12px;
  font-weight: bold;
  color: #fff;
  background: #CD4427;
  border: 1px solid;
  border-radius: 16px;
  outline: 0;
  box-shadow: inset 0 1px white, 0 1px 2px rgba(0, 0, 0, 0.15);
}
input[type=submit]:hover {
    background: #FF6347; /* Change the background color on hover */
  cursor: pointer;
}


</style>