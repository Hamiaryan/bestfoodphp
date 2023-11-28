<?php
// Check if the product ID is provided in the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Connect to your database (replace these details with your actual database connection details)
    require '../db.php';

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL to delete a record
    $sql = "DELETE FROM products WHERE product_id = $product_id";

    if ($conn->query($sql) === TRUE) {
        echo '<script type="text/javascript">window.location.href = "admin_dashboard.php";</script>';
        
    } else {
        echo "Error deleting product: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Product ID not provided";
}
?>
