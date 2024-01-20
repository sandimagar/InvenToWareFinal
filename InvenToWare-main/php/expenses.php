<?php





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/InvenToWare-main/css/dashboard.css">
    <title>Inventory Management System</title>

    <link rel="stylesheet" href="/InvenToWare-main/css/container_dashboard.css">
    <script src="https://kit.fontawesome.com/36c3b57b6b.js" crossorigin="anonymous"></script>
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
            display: flex;
            align-items: center;
            width: 100%;
            justify-content: space-between;
        }

        .product_Container {
            display: flex;
            align-items: center;
            width: 100%;
            justify-content: space-between;


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

        .Expenses {
            text-align: center;
        }

        .Expenses h2 {
            padding: 10px 12px;
            font-size: 1.6vw;

        }

        .Expenses input {
            padding: 6px 9px;
            outline: none;
            border-radius: 6px;
            border: 1px solid gray;
        }

        .Expenses select {
            padding: 6px 16px;
            border-radius: 6px;
            border: 1px solid gray;

        }

        .Expenses button {
            margin: 6px 8px;
            padding: 6px 15px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: .8vw;
            font-weight: 600;
            background: #3A8C93;
        }

        .Expenses label {
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
            window.history.replaceState(null, null, window.location.href)
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
            <div class="Expenses">
                <h2>Purchases</h2>
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
                $checkProductQuery1 = "SELECT * FROM purchases WHERE ProductId = $id";
                $result1 = $conn->query($checkProductQuery1);
                if ($result1->num_rows > 0) {
                    while ($row = $result1->fetch_assoc()) {
                        if ($row['ProductName'] == $name) {


                      $updateQuery = "UPDATE purchases SET ProductUnit = ProductUnit + $unit WHERE ProductId = $id";
                            if ($conn->query($updateQuery) === TRUE) {
                                echo "<div class='success'>Product added successfully!</div>";
                            } else {
                                echo "<div class = 'error'>Error updating product unit count: " . $conn->error . "</div>";
                            }
                        }else{
                            echo "<div class = 'error'>Please Re-Check Product ID </div>";
                        }
                    }
                } else {

                   


                        $sql1 = "INSERT INTO purchases (ProductName, ProductPrice,ProductId,ProductUnit,Status) VALUES ('$name', '$price','$id','$unit','$status')";


                        if ($conn->query($sql1) === TRUE) {
                        } else {
                            echo "<div class = 'error'>Error: " . $sql . $conn->error . "</div>";
                        }
                    } 
                $checkProductQuery = "SELECT * FROM stock WHERE ProductId = $id";
                $result = $conn->query($checkProductQuery);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row['ProductName'] == $name) {


                            $updateQuery = "UPDATE stock SET ProductUnit = ProductUnit + $unit WHERE ProductId = $id";
                            if ($conn->query($updateQuery) === TRUE) {
                                echo "<div class='success'>Product added successfully!</div>";
                            } else {
                                echo "<div class = 'error'>Error updating product unit count: " . $conn->error . "</div>";
                            }
                        }
                    }
                } else {

                   


                        $sql = "INSERT INTO stock (ProductName, ProductPrice,ProductId,ProductUnit,Status) VALUES ('$name', '$price','$id','$unit','$status')";
                        if ($conn->query($sql) === TRUE) {
                            echo "<div class='success'>Product added successfully !</div>";
                        } else {
                            echo "<div class = 'error'>Error: " . $sql . $conn->error . "</div>";
                        }
                    } 
                
          
                }
            




            if (isset($_POST['update'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $price = $_POST['price'];
                $status = $_POST['status'];
                $unit = $_POST['Unit'];
                $sql1 = "UPDATE purchases SET ProductName='$name', ProductPrice='$price' ,Status = '$status', ProductUnit = '$unit' WHERE ProductId=$id";
                $executor = $conn->prepare($sql1);
                $sql = "UPDATE stock SET ProductName='$name', ProductPrice='$price' ,Status = '$status', ProductUnit = '$unit' WHERE ProductId=$id";
                if ($conn->query($sql) === TRUE) {
                    echo "<div class = 'success'>Product updated successfully!</div>";
                } else {
                    echo "Error updating product: " . $conn->error;
                }
            }

          

            $sql = "SELECT * FROM stock";
            $result = $conn->query($sql);
            echo "<div class='product_Container'>
<p>Id</p>
<p>Item</p>
<p class='Price'>Price</p>
<p>Unit</p>
<p>Action</p>
<p>Edit</p>

</div>";
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    echo "<div class='product'>";
                    echo "<p>" . $row['ProductId'] . "</p>";

                    echo "<p>" . $row['ProductName'] . "</p>";
                    echo "<p>$" . $row['ProductPrice'] . "</p>";
                    echo "<p>" . $row["ProductUnit"] . "</p>";
                    if ($row["Status"] == "Completed") {

                        echo "<p class='completed'> Completed </p>";
                    } else {
                        echo "<p class='waiting'>Pending</p>";
                    }

                    echo "<a href='http://localhost/InvenToWare-main/php/expenses.php?id=" . $row['ProductId'] . "'><i class='fa-solid fa-trash'></i></a>";
                    echo "</div>";
                }
            } else {
                echo "<div style='width=100%;padding:8px 1.5vw;font-size:1.6vw'>0 results</div>";
            }
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                $deletequery = "DELETE FROM stock Where ProductId=$id";
                $result = $conn->query($deletequery);
                $sql1 = "DELETE FROM purchases WHERE ProductId=$id";
                $executor = $conn->query($sql1);
            }
            $sqls = "SELECT ProductUnit, ProductPrice, Status FROM purchases";
            $results = $conn->query($sqls);

            $totalPurchases = 0;
            $pendingTransactions = 0;

            $pendingTransactionsUnit = 0;

            $completedTransactionsUnit = 0;

            $completedTransactions = 0;
            $totalunitspurchased = 0;
            if ($results->num_rows > 0) {
                while ($rows = $results->fetch_assoc()) {
                    $unitsPurchased = $rows['ProductUnit'];
                    $pricePerUnit = $rows['ProductPrice'];
                    $status = $rows['Status'];
                    if ($status == 'Pending') {
                        $pendingTransactionsUnit += $unitsPurchased;
                        $pendingTransactions += $unitsPurchased * $pricePerUnit;
                        $totalunitspurchased += $unitsPurchased;
                    } else {
                        $completedTransactionsUnit += $unitsPurchased;
                        $totalunitspurchased += $unitsPurchased;

                        $completedTransactions += $unitsPurchased * $pricePerUnit;
                    }
                    $productPurchased = ($pendingTransactionsUnit + $completedTransactionsUnit) * $pricePerUnit;
                    $totalPurchases += $productPurchased;
                }
                echo "<h3 style='color:Green'>Total Completed Transaction: $" . number_format($completedTransactions, 2) . "</h3>";

                echo "<h3 style='color:orangered'>Total Pending Transaction: $" . number_format($pendingTransactions, 2) . "</h3>";
                echo "<h3>Total Purchases: $" . number_format($totalPurchases, 2) . "</h3>";
            }
            
            $_SESSION["totalunitspurchased"] = $totalunitspurchased;

            $_SESSION["TotalPurchases"] = $totalPurchases;
            $conn->close();

            ?>
        </div>

    </div>
</body>

</html>