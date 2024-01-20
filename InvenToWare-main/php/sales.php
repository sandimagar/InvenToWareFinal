<?php

// echo ;

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/InvenToWare-main/css/dashboard.css">
    <title>Inventory Management System</title>
    <script src="https://kit.fontawesome.com/36c3b57b6b.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/InvenToWare-main/css/container_dashboard.css">
    <link rel="stylesheet" href="/InvenToWare-main/css/sales.css">
    <style>
        .product {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        .product a {
            text-decoration: none;
            color: red;
            margin: 8px 12px;
            padding: 6px 12px;
            font-size: 1.1vw;
        }

        .product a i {
            color: red;
            cursor: pointer;
        }

        .product p {
            margin: 8px 12px;
            padding: 6px 12px;
            font-size: 1.1vw;
            text-transform: capitalize;
            border-right: 1px solid whitesmoke;


        }

        .success {
            width: 100%;
            height: 3vw;
            background-color: #4CAF50;
            font-size: 1.3vw;
            font-weight: 500;
            padding: 10px 12px;
            margin: 10px 6px;
        }

        .product {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .product_Container {
            display: flex;
            align-items: center;
            justify-content: space-between;

            width: 100%;

        }

        .product_Container p {
            padding: 6px 12px;
            margin: 8px 12px;
            font-size: 1.4vw;
            border-right: 1px solid whitesmoke;
        }

        .completed {
            color: #4CAF50;
        }

        .waiting {
            color: orangered;
        }

        .Sales {
            text-align: center;
        }

        .Sales h2 {
            padding: 10px 12px;
            font-size: 1.6vw;

        }

        .Sales input {
            padding: 6px 9px;
            outline: none;
            border-radius: 6px;
            border: 1px solid gray;
        }

        .Sales select {
            padding: 6px 16px;
            border-radius: 6px;
            border: 1px solid gray;

        }

        .Sales button {
            margin: 6px 8px;
            padding: 6px 15px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: .8vw;
            font-weight: 600;
            background: #3A8C93;
        }

        .Sales label {
            padding: 6px 15px;
        }

        .error {
            width: 100%;
            height: 3vw;
            background-color: #ef233c;
            ;
            font-size: 1.3vw;
            font-weight: 500;
            padding: 10px 12px;
            margin: 10px 6px;
            text-align: left;
        }
    </style>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>

<body>
    <?php
    include("./dashboardnav.php");

    ?>
    <div class="side_content_container">
        <?php
        include("./sidenav.php");
        ?>
        <div class="container_dashboard">
            <div class="Sales">
                <h2>Sales</h2>
                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                    <label for="id">Product Id</label>
                    <input type="number" name="id" required>
                    <label for="name">Product Name:</label>
                    <input type="text" name="name" id="name" required>
                    <label for="price">Price:</label>
                    <input type="number" name="price" id="price" step="0.01" required>
                    <label for="Unit">Unit:</label>
                    <input type="number" name="Unit" required>
                    <select name="status" id="status">
                        <option value="Completed">Completed</option>
                        <option value="Pending">Pending</option>
                    </select>
                    <button type="submit" name="add">Add Product</button>
                    <button type="submit" name="update">Update Product</button>
                </form>
            </div>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "products_db";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_POST['add'])) {
                $id = $_POST['id'];
                $status = $_POST['status'];
                $name = $_POST['name'];
                $price = $_POST['price'];
                $unit = $_POST['Unit'];


         

                $checkProductQuery = "SELECT * FROM stock WHERE ProductId = $id ";
                $result = $conn->query($checkProductQuery);

                if ($result->num_rows > 0) {
                    while ($rows = $result->fetch_assoc()) {
                        if ($rows["ProductUnit"] >= $unit) {
                            $updateQuery = "UPDATE stock SET ProductUnit = ProductUnit - $unit  WHERE ProductId = $id";
                            if ($conn->query($updateQuery) === TRUE) {

                                $checkProductQuery1 = "SELECT * FROM Sales WHERE ProductId = $id";
                                $result1 = $conn->query($checkProductQuery1);
                                if ($result1->num_rows > 0) {
                                    while ($row = $result1->fetch_assoc()) {
                                        if ($row['ProductName'] == $name) {


                                            $updateQuery = "UPDATE Sales SET ProductUnit = ProductUnit + $unit WHERE ProductId = $id";
                                            if ($conn->query($updateQuery) === TRUE) {
                                                echo "<div class='success'>Product added successfully!</div>";
                                            } else {
                                                echo "<div class = 'error'>Error updating product unit count: " . $conn->error . "</div>";
                                            }
                                        }
                                    }
                                } else {




                                    $sql1 = "INSERT INTO Sales (ProductName, ProductPrice,ProductId,ProductUnit,Status) VALUES ('$name', '$price','$id','$unit','$status')";


                                    if ($conn->query($sql1) === TRUE) {
                                    } else {
                                        echo "<div class = 'error'>Error: " . $sql . $conn->error . "</div>";
                                    }
                                }
                                
                             }} else {
                            echo "<div class = 'error'> Insufficient units for product with ID: $id </div>";
                        }
                    }
                } else {
                    echo "<div class = 'error'>Product Not Found with Id : $id</div>";
                }
            }

            if (isset($_POST['update'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $price = $_POST['price'];
                $status = $_POST['status'];
                $unit = $_POST['Unit'];

                $sql = "UPDATE sales SET ProductName='$name', ProductPrice='$price' ,Status = '$status', ProductUnit = '$unit' WHERE ProductId=$id";
                if ($conn->query($sql) === TRUE) {
                    echo "<div class = 'success'>Product updated successfully!</div>";
                } else {
                    echo "Error updating product: " . $conn->error;
                }
            }

            if (isset($_POST['delete'])) {
                $id = $_POST['id'];
                $sql = "DELETE FROM sales WHERE ProductId=$id";
                if ($conn->query($sql) === TRUE) {
                    echo "<div class = 'success'>Product deleted successfully!</div>";
                } else {
                    echo "Error deleting product: " . $conn->error;
                }
            }

            $sql2 = "SELECT * FROM sales";
            $results = $conn->query($sql2);
            echo "<div class='product_Container'>

            <p>Id</p>
            <p>Item</p>

            <p class='Price'>Price</p>


            <p>Unit</p>

            <p>Action</p>

            <p>Edit</p>
        

            </div>";

            if ($results->num_rows > 0) {

                while ($row2 = $results->fetch_assoc()) {


                    echo "<div class='product'>";

                    echo "<p>" . $row2['ProductId'] . "</p>";


                    echo "<p>" . $row2['ProductName'] . "</p>";


                    echo "<p>$" . $row2['ProductPrice'] . "</p>";

                    echo "<p>" . $row2["ProductUnit"] . "</p>";

                    if ($row2["Status"] == "Completed") {


                        echo "<p class='completed'>" . $row2["Status"] . "</p>";
                    } else {

                        echo "<p class='waiting'>" . $row2["Status"] . "</p>";
                    }


                    echo "<a href='http://localhost/InvenToWare-main/php/sales.php?id=" . $row2['ProductId'] . "'><i class='fa-solid fa-trash'></i></a>";
                    echo "</div>";
                }
            } else {
                echo "<div style='width=100%;padding:8px 1.5vw;font-size:1.6vw'>0 results</div>";
            }
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                $deletequery = "DELETE FROM sales Where ProductId=$id";
                $result = $conn->query($deletequery);
            }


            $sqls = "SELECT ProductUnit, ProductPrice,Status FROM sales";

            $results = $conn->query($sqls);



            $totalSales = 0;
            $pendingTransactions = 0;

            $pendingTransactionsUnit = 0;

            $completedTransactionsUnit = 0;

            $completedTransactions = 0;

            $totalunitsSold = 0;

            if ($results->num_rows > 0) {

                while ($rows = $results->fetch_assoc()) {

                    $unitsSold = $rows['ProductUnit'];

                    $pricePerUnit = $rows['ProductPrice'];

                    $status = $rows['Status'];

                    if ($status == 'Pending') {
                        $totalunitsSold += $unitsSold;

                        $pendingTransactionsUnit += $unitsSold;

                        $pendingTransactions += $unitsSold * $pricePerUnit;
                    } else {
                        $totalunitsSold += $unitsSold;

                        $completedTransactionsUnit += $unitsSold;


                        $completedTransactions += $unitsSold * $pricePerUnit;
                    }

                    $productSold = ($pendingTransactionsUnit + $completedTransactionsUnit) * $pricePerUnit;

                    $totalSales += $productSold;
                }

                echo "<h3 style='color:Green'>Total Completed Transaction: $" . number_format($completedTransactions, 2) . "</h3>";


                echo "<h3 style='color:orangered'>Total Pending Transaction: $" . number_format($pendingTransactions, 2) . "</h3>";

                echo "<h3>Total Sales: $" . number_format($totalSales, 2) . "</h3>";
            }
            $sqli = "SELECT ProductName, SUM(ProductUnit) AS total_units_sold 
            FROM Sales 
            GROUP BY ProductName 
            ORDER BY total_units_sold DESC";

            $resultss = $conn->query($sqli);
            $_SESSION["totalunitssold"] = $totalunitsSold;
            if ($resultss->num_rows > 0) {
                $mostPopular = $leastPopular = null;

                $mostPopularRow = $resultss->fetch_assoc();
                $mostPopular = $mostPopularRow['ProductName'];
                $resultss->data_seek($resultss->num_rows - 1);
                $leastPopularRow = $resultss->fetch_assoc();
                $leastPopular = $leastPopularRow['ProductName'];

                $_SESSION['MostPopular'] = $mostPopular;
                $_SESSION['LeastPopular'] = $leastPopular;
            } else {
                $mostPopular = "Empty";
                $leastPopular = "Empty";
            }
            $_SESSION["TotalSales"] = $totalSales;

            $conn->close();
            $_SESSION["Totalunitssold"] = $totalunitsSold;
            ?>
        </div>
    </div>
</body>

</html>