<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <!-- Include the global header -->
    <?php include '../header.php'; ?>

    <style>
        /* Styles for the page layout and elements */
        body {
            font-family: 'Arial', sans-serif;
            font-size: 16px;
            background-image: url('http://localhost:8080/bestfood/asset/back.jpg');
            background-size: cover;
            background-position: center;
        }

        /* Add the rest of your styles here... */

        .product-details {
            width: 60%;
            margin: 20px auto;
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            box-sizing: border-box;
        }

        h2 {
            color: #333;
        }

        p {
            color: #666;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }

      

            


        /* Additional styles for the form */
        form {
            margin-top: 20px;
            display: block;
            
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out, color 0.5s ease-in-out;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    <!-- Your global header goes here -->

    <?php
    // Include the database connection file
    require '../db.php';

    // Check if the product ID is provided in the URL
    if (isset($_GET['id'])) {
        $productId = $_GET['id'];

        // If the form is submitted, update the product details
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get data from the form submission
            $productName = $_POST['product_name'];
            $productDescription = $_POST['product_description'];
            $productPrice = $_POST['product_price'];
            $productPhoto = $row['product_photo']; // default to the existing image

            // Check if a new image is submitted
            if (!empty($_FILES['new_product_photo']['name'])) {
                // Process the new image
                $targetDir = "uploads/";
                $targetFile = $targetDir . basename($_FILES['new_product_photo']['name']);
                move_uploaded_file($_FILES['new_product_photo']['tmp_name'], $targetFile);
                $productPhoto = basename($_FILES['new_product_photo']['name']);
            }

            // Update product details in the database using prepared statements
            $updateQuery = "UPDATE products SET
                            product_name = ?,
                            product_description = ?,
                            product_price = ?,
                            product_photo = ?
                            WHERE product_id = ?";

            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("ssdsi", $productName, $productDescription, $productPrice, $productPhoto, $productId);

            if ($stmt->execute()) {
                echo "";
            } else {
                echo "<p>Error updating product details: " . $stmt->error . "</p>";
            }

            $stmt->close();
        }

        // Retrieve product data from the database for the specified ID
        $result = $conn->query("SELECT * FROM products WHERE product_id = $productId");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Display product details
            echo "<div class='product-details'>";
            

            $product_photo_path = 'uploads/' . $row['product_photo'];
            if (file_exists($product_photo_path)) {
                echo "<img src='{$product_photo_path}' alt='{$row['product_name']}'>";
            } else {
                echo "<p>Image not found</p>";
            }

            // Display the update form with the new file input for images
            echo "
                <form action='' method='post' enctype='multipart/form-data'>
                    <input type='hidden' name='product_id' value='{$productId}'>
                    <label for='product_name'>Product Name:</label>
                    <input type='text' id='product_name' name='product_name' value='{$row['product_name']}' required>

                    <label for='product_description'>Product Description:</label>
                    <textarea id='product_description' name='product_description' required>{$row['product_description']}</textarea>

                    <label for='product_price'>Product Price:</label>
                    <input type='text' id='product_price' name='product_price' value='{$row['product_price']}' required>

                    <label for='new_product_photo'>New Product Photo:</label>
                    <input type='file' id='new_product_photo' name='new_product_photo'>

                    <button type='submit'>Update Product</button>
                </form>
            ";

            // Link back to the product listing page using the new class
            
            echo "</div>";
        } else {
            echo "<p>Product not found</p>";
        }
    } else {
        echo "<p>Invalid product ID</p>";
    }

    // Close the database connection
    $conn->close();
    ?>

    <!-- Your global footer goes here -->
    <?php include '../include/global_footer.php'; ?>

</body>

</html>
