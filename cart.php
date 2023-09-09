<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>購物車</title>
  <style>
    .cart-container {
      width: 100%;
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      background-color: #f5f5f5;
    }

    .cart-table {
      width: 100%;
      border-collapse: collapse;
    }

    .cart-table th {
      padding: 10px;
      text-align: left;
      background-color: #ddd;
    }

    .cart-table td {
      padding: 10px;
      border-bottom: 1px solid #ccc;
    }

    .cart-table td img {
      max-width: 100px;
      height: auto;
    }

    .cart-total {
      text-align: right;
      margin-top: 20px;
    }

    .cart-buttons {
      text-align: right;
      margin-top: 10px;
    }

    .cart-buttons button {
      padding: 10px 20px;
      background-color: #4caf50;
      color: #fff;
      border: none;
      cursor: pointer;
    }

    .cart-buttons button:hover {
      background-color: #45a049;
    }

    .empty-cart-message {
      text-align: center;
      padding: 20px;
      color: #888;
    }
  </style>
</head>


<body>
    <?php
        // 包含共用模板
        include 'after_login_base.php';
    ?>
    <?php 
    if (isset($_POST['to_buy'])){
      $_SESSION['cart'] = null;

      header("Location: all_product.php");
    }
  ?>
    <div class="cart-container">
    <h1>Shopping Cart</h1>
    
    <table class="cart-table">
      <thead>
        <tr>
          <th>Product_name</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $product_id='';
        $all_price = 0;
        if (isset($_SESSION['cart'])){
          foreach ($_SESSION['cart'] as $product_id => $number) {
            $sql="SELECT p.name,p.price,p.image_url FROM products p WHERE p.product_id = ${product_id}";
            $stmt=mysqli_prepare($link,$sql);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt,$p_name,$price,$image);//預備將變數傳下去
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
            $product_total_price = $price * $number;
            $all_price = $all_price + $product_total_price;
            echo " <tr>
                    <td>
                      <img src='{$image}'>
                      <span>{$p_name}</span>
                    </td>
                    <td>{$price}</td>
                    <td>{$number}</td>
                    <td>{$product_total_price}</td>
                  </tr>";
          }
        }
        ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3">Total:</td>
          <td><?php echo $all_price ?></td>
        </tr>
      </tfoot>
    </table>
    <form id='myform' method="POST">
      <div class="cart-buttons">
        <input type ='hidden' name='to_buy' value='yes'>
        <button id='buy'>購買</button>
      </div>
    </form>

  </div>
  <script>


    $("#buy").off("click").on("click",function(event) {
      alert("購買成功!");

      $("#myform").submit()
      
  });
  </script>  
  
</body>
</html>