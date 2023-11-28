



<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
require 'db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include the global header -->
    <?php include 'Home.php';  ?>
   
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('http://localhost:8080/bestfood/asset/back.jpg');
            /* Replace 'path/to/your/image.jpg' with the actual path to your background image */
            background-size: cover;
            /* This property ensures that the background image covers the entire container */
            background-position: center;
            /* This property centers the background image */
        }

        .overlay {
            width: 100%;
            height: 100%;
            padding: 1px;
        }

        * {
            padding: 0;
            margin: 0;
            position: relative;
            box-sizing: border-box;
        }

        .listing-section,
        .cart-section {
            width: relative;
            float: left;
            padding: 1%;
            border-bottom: 0.01em solid #dddbdb;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .listing-section:hover {
            box-shadow: 1.5px 1.5px 2.5px 3px rgba(0, 0, 0, 0.4);
            -webkit-box-shadow: 1.5px 1.5px 2.5px 3px rgba(0, 0, 0, 0.4);
            -moz-box-shadow: 1.5px 1.5px 2.5px 3px rgba(0, 0, 0, 0.4);
        }

        .product {
            width: 300px;
            margin: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px #ccc;
        }

        .product:hover {
            box-shadow: 1.5px 1.5px 2.5px 3px rgba(0, 0, 0, 0.4);
            -webkit-box-shadow: 1.5px 1.5px 2.5px 3px rgba(0, 0, 0, 0.4);
            -moz-box-shadow: 1.5px 1.5px 2.5px 3px rgba(0, 0, 0, 0.4);
        }

        .image-box {
            width: 100%;
            overflow: hidden;
            border-radius: 2% 2% 0 0;
        }

        .images {
            width: 100%;
            /* Adjust the width as needed */
            height: 15em;
            /* Adjust the height as needed */
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            border-radius: 2% 2% 0 0;
            transition: all 1s ease;
            -moz-transition: all 1s ease;
            -ms-transition: all 1s ease;
            -webkit-transition: all 1s ease;
            -o-transition: all 1s ease;
        }

        .image-box img {
            width: 100%;
        }

        .images:hover {
            transform: scale(1.2);
            overflow: hidden;
            border-radius: 2%;
        }

        .text-box {
            width: 100%;
            float: left;
            border: 0.01em solid #dddbdb;
            border-radius: 0 0 2% 2%;
            padding: 1em;
            background: rgba(255, 255, 255, 0.5);
        }

        .text-box:hover {

            -webkit-box-shadow: 1.5px 1.5px 2.5px 3px rgba(0, 0, 0, 0.4);
            -moz-box-shadow: 1.5px 1.5px 2.5px 3px rgba(0, 0, 0, 0.4);
        }

        h2,
        h3, {
            float: left;
            font-family: 'Roboto', sans-serif;
            font-weight: 400;
            font-size: 1em;
            text-transform: uppercase;
            margin: 0.2em auto;
        }

        .item,
        .price {
            clear: left;
            width: 100%;
            text-align: center;
        }

        .price {
            color: black;
        }

        .description {
            float: left;
            clear: left;
            width: 100%;
            font-family: 'Roboto', sans-serif;
            font-weight: 300;
            font-size: 1em;
            text-align: center;
            margin: 0.2em auto;
        }

        .action-buttons {
            padding: 20%;
            background-color: 107, 22, 3, 0.4;
            border: none;
            border-radius: 2%;
        }

        .action-buttons:hover {
            bottom: 0.1em;
        }

        .action-buttons:focus {
            outline: 0;
        }

        

        .buy-button,
        .submit-rating-button {
            background-color: #55170A;
            /* Green background color */
            color: white;
            /* White text color */
            padding: 10px 20px;
            /* Padding for the button */
            border: none;
            /* Remove button border */
            text-align: center;
            /* Center text within the button */
            text-decoration: none;
            /* Remove default text decoration */
            display: inline-block;
            /* Display as an inline block */
            font-size: 16px;
            /* Set font size */
            margin: 4px 2px;
            /* Set margin */
            cursor: pointer;
            /* Add cursor pointer on hover */
            border-radius: 10%;
        }

        .rating-form {
            display: flex;
            flex-direction: column;
        }

        .rating-form label {
            font-family: 'Roboto', sans-serif;
            font-weight: 100;
            font-size: 1em;
            margin: 0.2em auto;
        }

        .star-rating {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            margin: 0.5em auto;
        }
    </style>
</head>

<body>
    <div class="overlay">
        <div class="listing-section">
            <?php
            // Retrieve photos from the 'products' table
            $result = $conn->query("SELECT product_id, product_photo, product_name, product_price, product_description,product_rating FROM products");

            // Handle rating submission
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['productId']) && isset($_POST['rating'])) {
                    $productId = $_POST['productId'];
                    $rating = intval($_POST['rating']);

                    // Validate rating value (you can add more validation logic)
                    if ($rating >= 0 && $rating <= 5) {
                        // Update the product rating in the products table using prepared statements
                        $stmt = $conn->prepare("UPDATE products SET product_rating = ? WHERE product_id = ?");
                        $stmt->bind_param("ii", $rating, $productId);
                        $stmt->execute();
                        $stmt->close();
                    }
                }
            }
            // Loop through the result set
            while ($row = $result->fetch_assoc()) {
                $productId = $row['product_id'];
                $product_photo_path = 'Admin/uploads/' . $row['product_photo'];
                $product_name = $row['product_name'];
                $product_price = $row['product_price'];
                $product_description = $row['product_description'];
                $product_rating = $row['product_rating'];

                echo '<div class="product">';
                echo '<div class="image-box">';
                echo "<div class=\"images\" id=\"image-1\"><img src=\"$product_photo_path\" alt=\"$product_name\"></div>";
                echo '</div>';
                echo '<div class="text-box">';
                echo "<h2 class=\"item\">$product_name</h2>";
                echo "<h3 class=\"price\">$product_price</h3>";
                echo "<p class=\"description\">$product_description</p>";
                echo "<p class=\"rateshow\">Rating: $product_rating</p>";
               
                echo '</div>'; // Close the "product" div
                echo '</div>'; // Close the "listing-section" div
                
            }

            // Close the database connection
            $conn->close();
            ?>
        </div>
    </div>

    <!-- Include the global footer -->


    <script>
        function buyProduct(productId, productName, productPrice) {
            alert(`Buying ${productName} for ${productPrice}`);
            // Add your logic here for handling the buy action, for example, redirecting to a checkout page.
        }
    </script>
</body>

</html>
;
 
<?php
include 'include/global_footer.php';
 
 ?>


