

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Include the global header -->
    <?php include '../header.php'; ?>
    

    <!-- Add Product Section Styles -->
    <style>
       
       body {
            margin: 0;
            padding: 0;
            background-image: url('http://localhost:8080/bestfood/asset/back.jpg');
            background-size: cover;
            background-position: center;
          
        }

    h2 {
        color: #fff;
        margin-bottom: 20px;
        font-size: 20px;
        text-align: center;
        padding-top:20px;
    }

    form {
        max-width: 400px;
        margin: auto;
        padding: 10px;
        background-color: #f4f4f4; /* Set a background color for the form */
        border-radius: 8px; /* Optional: Add border-radius for rounded corners */
        
    }

    label {
        display: block;
        margin-bottom: 8px;
    }

    input,
    textarea {
        width: calc(100% - 16px);
        padding: 8px;
        margin-bottom: 8px;
        box-sizing: border-box;
    }

    button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }

    .Update_products {
    margin-top: 20px; /* Adjust this value to add more space */
    margin-bottom: 20px; /* Adjust this value to add more space at the bottom */
}
</style>
</style>

    </style>
</head>

<body>
<h2>Add Product</h2>
    <form action="admin_dashboard.php" method="post" enctype="multipart/form-data">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required>

        <label for="product_description">Product Description:</label>
        <textarea id="product_description" name="product_description" required></textarea>

        <label for="product_price">Product Price:</label>
        <input type="number" id="product_price" name="product_price" required>

        <label for="product_photo">Product Photo:</label>
        <input type="file" id="product_photo" name="product_photo" accept="image/*" required>

        <button type="submit">Add Product</button>

    <!-- Your authenticated admin content goes here -->

    </form>
    <div class="Update_products">
    <?php include 'Update_products.php'; ?>
    </div>
    <!-- Include the global footer -->
    <?php include '../include/global_footer.php'; ?>

   
</body>



<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
require '../db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];

    // File upload handling
    $upload_dir = __DIR__ . '/uploads/';

    // Generate a unique filename
    $timestamp = time();
    $extension = pathinfo($_FILES['product_photo']['name'], PATHINFO_EXTENSION);
    $product_photo_filename = $timestamp . '_' . uniqid() . $extension;
    $product_photo_path = $upload_dir . $product_photo_filename;

    // Move the uploaded file to the specified directory
    if (move_uploaded_file($_FILES['product_photo']['tmp_name'], $product_photo_path)) {
        // Insert the data into the 'products' table
        $stmt = $conn->prepare("INSERT INTO products (product_name, product_description, product_price, product_photo, photo_path) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdss", $product_name, $product_description, $product_price, $product_photo_filename, $product_photo_path);

        if ($stmt->execute()) {
            echo "";
        } else {
            echo "<p>Error executing SQL statement: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        echo "<p>File upload failed.</p>";
    }
} else {
    echo "<p>Error uploading file. Check the server logs for more information.</p>";
    error_log("File upload failed: " . $_FILES['product_photo']['error']);
}

// Close the database connection
$conn->close();
?>
