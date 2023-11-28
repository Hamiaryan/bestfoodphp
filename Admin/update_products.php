<?php
require '../db.php';

// Retrieve data from the 'products' table
$result = $conn->query("SELECT product_id, product_photo, product_name, product_price, product_description,product_rating FROM products");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing</title>
    <!-- Include the global header -->
</head>

<body>

<!-- Your global header goes here -->
<div class="product-container p-6 overflow-scroll px-0">
    <table class="mt-4 w-full min-w-max table-auto text-left">
        <caption>Admin Dashboard</caption>
        <thead>
            <!-- Table header row goes here -->
            <tr>
                <th class="th" title="Product ID">ID</th>
                <th class="th" title="Product Photo">Photo</th>
                <th class="th" title="Product Name">Name</th>
                <th class="th" title="Product Description">Description</th>
                <th class="th" title="Product Rating">Rating</th>
                <th class="th" title="Product Price">Price</th>
                <th class="th" title="Product action">Action</th>
            </tr>
        </thead>
       
        <tbody>
            <?php
            // Loop through the result set
            while ($row = $result->fetch_assoc()) {
                $product_photo_path = 'uploads/' . $row['product_photo'];
                $product_id = $row['product_id'];
                $product_name = $row['product_name'];
                $product_price = $row['product_price'];
                $product_rating = $row['product_rating'];
                $product_description = $row['product_description'];
              

            ?>
                <tr>
                    <!-- Your table rows go here -->

                    <td class="p-4 border-b border-blue-gray-50" title="Product ID">
                        <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal product-id"><?php echo $product_id; ?></p>
                    </td>
                    <td class="p-4 border-b border-blue-gray-50" title="Product Photo">
                        <img src="<?php echo $product_photo_path; ?>" alt="<?php echo $product_name; ?>" class="w-16 h-16 object-cover product-photo">
                    </td>
                    <td class="p-4 border-b border-blue-gray-50" title="Product Name">
                        <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal product-name"><?php echo $product_name; ?></p>
                    </td>
                    <td class="p-4 border-b border-blue-gray-50" title="Product Description">
                        <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal product-description"><?php echo $product_description; ?></p>
                    </td>
                    <td class="p-4 border-b border-blue-gray-50" title="Product Rating">
                        <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal product-rating"><?php echo $product_rating; ?></p>
                    </td>
                    <!-- Product Price -->
                    <td class="p-4 border-b border-blue-gray-50" title="Product Price">
                        <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal product-price">$<?php echo $product_price; ?></p>
                    </td>

                    <!-- Actions -->
                    <td class="p-4 border-b border-blue-gray-50" title="Actions">
                        <!-- View Details Link -->
                        <div class='product-actions'>
                            <a href='view_product.php?id=<?php echo $product_id; ?>'>Details</a>
                        </div>

                        <!-- Edit and Delete Buttons -->
                        <div class='product-actions'>
                            <a href='delete_product.php?id=<?php echo $product_id; ?>'>Delete</a>
                        </div>
                    </td>
                   
                   
                      </td>

                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Your global footer goes here -->

<!-- Your global footer goes here -->
</div>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>



<style>
   body {
    font-family: 'Arial', sans-serif;
    font-size: 16px;
    line-height: 1.5;
    color: #444;
    background-color: #f8fafc;
    margin: 0;
    
}
caption{ 
    font-size: 20px;
    font-weight: 600;
    padding: 10px;
    background-color: #f8fafc;
    color: #444;

}
   
.product-container {
    width: 80%; /* Adjust the percentage to your preference */
    margin: 0 auto; /* This centers the container */
    max-width: 100%;
   ;
}

    .p-4 {
      overflow-scroll: auto;
      padding: 6px;
    }

   
.th {
  cursor: pointer;
    border-bottom: 1px solid #cbd5e0;
    background-color: #f8fafc;
    padding: 16px;
    
    text-align: left
}

.td {
    cursor: pointer;
    border: none;
    background-color: #f8fafc;
    padding: 16px;
    transition: background-color 0.3s ease-in-out;
}

tr {
    margin-bottom: 10px; /* Add spacing between table rows */
    background-color: #edf2f7

    
}
tr:hover {
    background-color: #edf2f7; /* Change the background color on hover */
    transform: scale(1.1); /* Increase the size on visit */
    transition: transform 0.3s ease-in-out;


}

table {
    width: 100%;
    border-collapse: collapse;
}

    .table th:hover {
  background-color: #edf2f7;
}


    .product-photo {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 10%;
    }

    .product-name {
        font-weight: bold;
    }

    .product-description {
        color: #666;
    }

    .product-price {
        color: green;
    }
  

    .product-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    
}

.product-actions a {
    text-decoration: none;
    padding: 8px 12px;
    background-color: lightgray;
   
    border-radius: 4px;
    color: #3490dc;
   
}

.product-actions a:hover {
    background-color: gray;
    color: #ffffff;
}
    
</style>