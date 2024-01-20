<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "products_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST["search"])) {
  $item = $_POST["Searchname"];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/InvenToWare-main/css/dashboard.css">
  <title>Inventory Management System</title>

  <link rel="stylesheet" href="/InvenToWare-main/css/container_dashboard.css">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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

    .OnStock {
      color: #4CAF50;
    }

    .OutOfStock {
      color: orangered;
    }

    .stock {
      text-align: center;
    }

    .stock h2 {
      padding: 10px 12px;
      font-size: 1.6vw;

    }

    .stock input {
      padding: 6px 9px;
      outline: none;
      border-radius: 6px;
      border: 1px solid gray;
    }

    .stock select {
      padding: 6px 16px;
      border-radius: 6px;
      border: 1px solid gray;

    }

    .stock button {
      margin: 6px 8px;
      padding: 6px 15px;
      border-radius: 6px;
      border: none;
      cursor: pointer;
      font-size: .8vw;
      font-weight: 600;
      background: #3A8C93;
    }

    .stock label {
      padding: 6px 15px;
    }

    .profit {
      width: 25vw;
      height: 6vw;
      background-color: #4CAF50;
      display: flex;
      justify-content: center;
      font-size: 2vw;
      align-items: center;
    }

    .netPurchases {
      font-size: 2vw;
      width: 25vw;
      height: 6vw;
      display: flex;
      justify-content: center;
      font-weight: 600;
      align-items: center;
      border-radius: 6px;
      background-color: skyblue;

    }

    .netSales {
      background-color: orange;

      border-radius: 6px;
      width: 25vw;
      font-size: 2vw;
      font-weight: 600;

      height: 6vw;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .loss {
      width: 25vw;
      height: 6vw;
      background-color: #ef233c;
      border-radius: 6px;
      font-weight: 600;
      font-size: 2vw;
      display: flex;
      justify-content: center;
      align-items: center;
    }
  </style>
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
      <div class="container_das">
        <form class="form_search" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
          <label for="name">Product Name:</label>
          <input type="text" name="Searchname" id="Searchname">

          <button type="submit" name="search">Search</button>
          <button type="submit" name="refresh"> Refresh</button>
        </form>

        <!-- <div class="contents_linegraph"> -->





      </div>

      <?php
$Totalpurchases = $_SESSION["TotalPurchases"];
$TotalSales = $_SESSION["TotalSales"];
$ProfitLoss = $TotalSales - $Totalpurchases;
$totalPurchasedUnits = $_SESSION["totalunitspurchased"];
$totalunitsSold = $_SESSION["Totalunitssold"];
$remStock = $totalPurchasedUnits - $totalunitsSold;

$item = "empty";

      if (isset($_POST['search'])) {
        $productName = $_POST['Searchname'];

        echo "<div class='product_Container'>

<p>Id</p>
<p>Item</p>

<p class='Price'>Price</p>


<p>Unit</p>

<p>Action</p>



</div>";
        $sql = "SELECT * FROM stock WHERE ProductName LIKE '%$productName%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {


            echo "<div class='product'>";

            echo "<p>" . $row['ProductId'] . "</p>";


            echo "<p>" . $row['ProductName'] . "</p>";


            echo "<p>$" . $row['ProductPrice'] . "</p>";

            echo "<p>" . $row["ProductUnit"] . "</p>";

            if ($row["ProductUnit"] <= 0) {

              $status = "Out Of Stock";
              echo "<p class='OutOfStock'>" . $status . "</p>";
            } else {
              $status = "On Stock";

              echo "<p class='OnStock'>" . $status . "</p>";
            }
          }
          echo "</div>";
        } else {
          echo "<p style = 'width :100%; text-align: center;'> No results found for '$productName'.</p>";
        }
      } ?>


      <div class="items_stock">



        <div class="profitloss">

          <div class="netPurchases">
           <i class='fa-solid fa-wallet'></i>
              Net Expenses :<?php
                            echo "$" . $Totalpurchases ?>
          </div>
          <div class="netSales">
         
              <i class='fa-solid fa-cart-shopping'></i>
              Net Sales : <?php
                          echo "$" . $TotalSales
                          ?>
     
          </div>
          <?php




          if ($ProfitLoss > 0) {

            echo "<div class = 'profit'>
  <i class='fa-solid fa-money-bill'></i>
  Net Profit : $$ProfitLoss </div> <br>";
          } else {
            echo "
  <div class = 'loss'>
  <i class='fa-solid fa-money-bill'></i>
  
  Net Loss : $$ProfitLoss</div> <br>";
          }

          ?>
        </div>
      </div>
    </div>

  </div>

</body>

</html>