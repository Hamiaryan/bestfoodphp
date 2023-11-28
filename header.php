<!-- index.php -->
<?php
            // Start the session at the beginning of the script
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            // Include the database connection file
            require '../db.php';

            // Check if the user is authenticated
            if (isset($_SESSION['admin_username']) && !empty($_SESSION['admin_username'])) {
                $userType = 'admin';
                $username = $_SESSION['admin_username'];
            } elseif (isset($_SESSION['buyer_username']) && !empty($_SESSION['buyer_username'])) {
                $userType = 'buyer';
                $username = $_SESSION['buyer_username'];
            } else {
                // Redirect to the login page if neither admin nor buyer is authenticated
                header("Location: ../Buyer/buyer_login_form.php");
                exit();
            }

            // Use prepared statements to prevent SQL injection
            if ($userType === 'admin') {
                $sql = "SELECT * FROM admins WHERE username = ?";
            } else {
                $sql = "SELECT * FROM buyers WHERE username = ?";
            }

            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

        
        

            ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BestFood - Fresh and Healthy Celery Goodness</title>

    <style>
        *{padding: 0; margin: 0; box-sizing: border-box;}
        body{height: 1000px;}
        header {
            background: url('http://localhost:8080/bestfood/asset/headerPhoto.jpeg');
            text-align: center;
            width: 100%;
            height: auto;
            background-size: cover;
            background-attachment: fixed;
            position: relative;
            overflow: hidden;
            border-radius: 0 0 85% 85% / 30%;
        }
        header .overlay{
            width: 100%;
            height: 100%;
            padding: 50px;
            color: #CD4427 ;
            
            background-image: linear-gradient( 135deg, #fff 1%, #fd5e086b 100%);
        }
       
        h1 {
            font-family: 'Dancing Script', cursive;
            font-size: 80px;
            margin-bottom: 30px;
        }
        h3{
            font-family: 'Open Sans', sans-serif;
            margin-bottom: 30px;
            color: #55170A;
        }
       
        .custom-nav {
            display: flex;
            justify-content: space-around;
            padding: 10px;
            background: rgba(148, 29, 8, 0.5);
        }
        .custom-nav a {
            color: white;
            text-decoration: none;
            text-shadow: none;
        }
        .welcome-container{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            height: 100%;
            
        }
        .welcome-text {
            font-family: 'Open Sans', sans-serif;
            margin-bottom: 30px;
            color: #55170A;
            font-size: 20px;
            text-align: center;
            text-shadow: none;
        }
        .button_home {
            border: none;
            outline: none;
            padding: 10px 20px;
            border-radius: 50px;
            color: #fff;
            background: #852511 ;
            margin-bottom: 50px;
            text-shadow: none;
        }
        .button_home:hover{
            cursor: pointer;
        }
        

        .circle-frame {
        width: 70px; /* Set the width and height to control the size of the circle */
        height: 70px;
        border-radius: 10%; /* This makes the container circular */
        background-color: rgba(148, 29, 8, 0.5);; /* Set the background color */
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        top: 90%;
        left: 50%;
        transform: translate(-50%, -50%);
        
    }
    .logout-link {
    text-decoration: none;
    color: #555; /* Set the color for the link */
    margin-top: 10px; /* Add margin to separate the welcome message and the logout link */
}

    .logout-link:hover {
    color: lightgray; /* Set the color for the link on hover */
}       

    .username {
    color: #fff; /* Set the color for the username */
    text-shadow: none;
    font-size: 15px;
}

    </style>
</head>

<body>
    <header>
        
        <div class="overlay">
    <nav class="custom-nav <?php echo $navClass; ?>">
        <?php
        // Add menu items based on user type
        if ($userType === 'admin') {
            echo '<a href="http://localhost:8080/Bestfood/Admin/admin_dashboard.php">Admin Dashboard</a>';
            echo '<a href="http://localhost:8080/Bestfood/Buyer/buyer_dashboard.php">User Look</a>';
            // Add other admin-specific menu items as needed
        } elseif ($userType === 'buyer') {
            echo '<a href="">Home</a>';
            echo '<a href="">My Orders</a>';
            // Add other buyer-specific menu items as needed
        }
        ?>
    </nav>
            <h1>BestFood</h1>
            <h3>Fresh and Healthy Celery Goodness</h3>
            <p class="welcome-text">Welcome to BestFood, your go-to destination for delicious and healthy celery-based dishes. We are passionate about promoting a healthy lifestyle through fresh and nutritious food choices</p>
           

            <?php
    // Check if there are rows in the result
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="circle-frame">';
            echo '<div class="welcome-container">';
            echo '<p class="welcome-message"><span class="username" ">' . $row['username'] . '</span></p>';
            echo '<a href="../include/logout.php" class="logout-link">Logout</a>';
            echo '</div>';
            echo '</div>';
        }
    }
    ?>
    </nav>

        </div>
    </header>

    <!-- Additional HTML content or sections can be added here -->

</body>

</html>
