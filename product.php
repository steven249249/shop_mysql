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
      <title>商品頁面</title>
  <style>
      .container {
            display: flex;
          }

         .product-image {
          margin-right: 20px;
          padding-right: 20px;
          border-right: 10px solid #ccc;
        }
          .product-details {
            flex-grow: 1;
            margin-top: 30px;
            padding-left: 20px;
            margin-top: 200px;
          }
          .product-details hr {
            border: none;
            border-top: 10px solid #ccc;
            margin: 20px 0;
          }
          .product-details p {
            margin: 20px 0;
            font-size: 20px;
          }

          .product-details h1 {
            font-size: 35px;
            margin: 0;
            border-down: 10px solid #ccc;

          }

          .product-details.price {
            margin-top: 10px;
            font-size: 20px;
          }
        .add-to-cart {
          background-color: #3498db;
          color: #fff;
          border: none;
          padding: 10px 20px;
          font-size: 16px;
          cursor: pointer;
          
        }
    </style>
</head>


<body>
    <?php
        // 包含共用模板
        include 'after_login_base.php';

    ?>
    <?php

        $product_id='';
        if (isset($_GET['id'])&&is_numeric($_GET['id'])){
            //建立mysql的資料庫連接
            $product_id=$_GET['id'];
        }
        $sql="SELECT p.name,s.name,p.price,p.image_url,p.description,count(l.product_id),p.product_id AS like_count FROM (sellers s INNER JOIN products p ON s.seller_id=p.seller_id) LEFT JOIN like_t l ON p.product_id = l.product_id  WHERE p.product_id = '${product_id}' GROUP BY p.product_id ";
        $product_result=mysqli_query($link,$sql);
        $total_post=mysqli_num_rows($product_result);

        if ($total_post>0){
            $stmt=mysqli_prepare($link,$sql);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt,$p_name,$s_name,$price,$image,$description,$like_count,$product_id);//預備將變數傳下去
            mysqli_stmt_fetch($stmt);
          
        }
    ?>
    <div id = 'container'>
        
    </div>
    <script>
        var p_name = '<?php echo $p_name; ?>';

        var s_name = '<?php echo $s_name; ?>';
        var price = '<?php echo $price; ?>';
        var image = '<?php echo $image; ?>';
        var description = '<?php echo $description; ?>';
        var like_count = '<?php echo $like_count; ?>';



        var newContent = `
                <div class="container">
                    <div class="product-image">
                      <img src="${image}" alt="商品圖片" width=550 height=800>
                    </div>
                    <div class="product-details">
                      <h1>${p_name}</h1>
                      <hr>
                      <p>${description}</p>
                      <hr>
                      <p class="price">價格:${price} TWD</p>
                      <form method='POST' id='myForm'>
                        <p>份數:</p>
                        <input type ='number' id= 'number' name='number'>

                        <br>
                        <br>
                        <button class="add-to-cart" id='submitButton'>加入購物車</button>
                      </form>
                      
                    </div>
                  </div>
                        `
        $("#container").html(newContent);
       $("#submitButton").click(function() {
    // 获取特定字段的值
           $("#myForm").submit()
         });
        
    </script>
    <?php
        if (isset($_POST["number"]) && $_POST["number"] !=0){
            if ($_SESSION['status']=='user'){
                $number = $_POST['number'];
                if (isset($_SESSION['cart'])){
                    $_SESSION['cart'][$product_id] = $number;
                }
                else{

                    $_SESSION['cart'] = array();
                    $_SESSION['cart'][$product_id] = $number;
                }
                echo "<div class='row' align=center>";
                echo '添加成功';
                echo "</div>";
            }
            else{
                echo "<div class='row' align=center>";
                echo '你必須是買家才可以購買';
                echo "</div>";
            }
        }
        else{
            echo "<div class='row' align=center>";
            echo "請填滿欄位";
            echo "</div>";
        }
    ?>

</body>
</html>