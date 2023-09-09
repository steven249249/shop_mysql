<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>文章列表</title>
	<style>
	.card {
	  display: flex;
	  flex-direction: column;
	  width: 570px;
	  border: 1px solid #ccc;
	  border-radius: 4px;
	  padding: 16px;
	  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
	  justify-content: center;
  	  align-items: center;
	}

	.card img {
	  width: 300px;
  	  height: 225px;
	  border-radius: 4px;
	  margin-bottom: 16px;
	}

	.card h4 {
	  margin: 0;
	  font-size: 20px;
	  font-weight: bold;
	  margin-bottom: 8px;
	}

	.card p {
	  height: 100px;
      	overflow: hidden;
	  margin: 0;
	  font-size: 16px;
	  line-height: 1.5;
	  text-align: center;

	}

	.card h4 {
	  text-align: center;
	}


	</style>
</head>
<body>
    <?php
        // 包含共用模板
        include 'after_login_base.php';

    ?>
    <form  method='POST'>
    	<input type="radio" name="choice" value="全部"> 全部
    	<input type="radio" name="choice" value="電子"> 電子
	  	<input type="radio" name="choice" value="家具"> 家具
	  	<input type="radio" name="choice" value="食物"> 食物
		<input type="submit" name="submit_with_info" value="搜尋">
    </form>
    <?php
    	if (isset($_SESSION['login_session']) and isset($_SESSION['userid']) and isset($_SESSION['user']) and isset($_SESSION['status']) and $_SESSION['login_session']==true){
        	echo "<br/><br/>";
		   } 	
        else{
        	echo "請先登入";	
	   	}
	   	if (isset($_POST['choice']) and $_POST['choice']!='全部'){
		   	$choice = $_POST['choice'];
		   	$sql = "SELECT p.product_id, p.name,p.image_url,p.description,COUNT(l.product_id) AS like_count
		        FROM products p
		        LEFT JOIN like_t l ON p.product_id = l.product_id
		        WHERE p.choice = '{$choice}'
		        GROUP BY p.product_id";
		}
		else{
			$sql = "SELECT p.product_id, p.name,p.image_url,p.description,COUNT(l.product_id) AS like_count
		        FROM products p
		        LEFT JOIN like_t l ON p.product_id = l.product_id
		        GROUP BY p.product_id";

		}
		//開啟指定的資料庫
		//是否有查詢到使用者紀錄
        // $sql = "SELECT products.product_id,products.name,products.image_url,products.description ,count(*) 
        // 		FROM products INNER JOIN like_t 
        // 		ON products.product_id = like_t.product_id
        // 		GROUP BY products.product_id";

        #GROUP是把一個搜尋結果根據指定的值去做分類，而分完類的又是另一個搜尋結果,只是表述成一行而已,實際上那一行裡面有很多東西,也就是另一個搜尋結果,所以我們是從那個搜尋結果去計算count,
        #計算select * FROM products p LEFT JOIN like_t l ON p.product_id = l.product_id where product_id = 35的時候,而count(l.product_id)就是計算這個搜尋結果裡面l.product_id不為空值的結果
        
        
       	$stmt=mysqli_prepare($link,$sql);
	    mysqli_stmt_execute($stmt);
	    mysqli_stmt_bind_result($stmt,$product_id,$name,$image,$description,$like_count);//預備將變數傳下去
	    echo "<div class='container-fluid'>";
	    
	    $count = 0 ;
	    while (mysqli_stmt_fetch($stmt)) {
	    	if ($count%3 == 0){
	    		$start = "<div class='row'></div><div class='col-sm-3 col-md-3 col-lg-3'>";
	    		$end = "</div>";
	    	}
	    	else{
	    		$start = "<div class='col-sm-1 col-md-1 col-lg-1'></div><div class='col-sm-3 col-md-3 col-lg-3'>";
	    		$end = "</div>";
	    	}
	    	echo $start;
	    	echo "<a href='./product.php?id={$product_id}'>";
	   		if ($like_count == 0){
	   		
				echo "<div class='card'>";
				  echo "<img src='{$image}' alt='Card Image'>";
				  echo "<h4>{$name}</h4>";
				  echo "<br>";
				 echo "<p>{$description}</p>";
				echo "</div>";

	   // 			echo "<div class='card'>";
				//   echo "<img src='{$image}' alt='Avatar' style='width: 200px; height: 150px;'>";
				//   echo "<div class='container'>";
				//     echo "<h4><b>{$name}</b></h4>" ;
				//     echo "<p>{$description}</p>"; 
				//   echo "</div>";
				// echo "</div>";

	   		}
			else{
				echo "<div class='card'>";
			  echo "<img src='{$image}' alt='Card Image'>";
			  echo "<h4>{$name}</h4>";
			  echo "<br>";
			 echo "<p>{$description}</p>";
			echo "</div>";
			}
			echo "</a>";
			echo $end;
			$count++;
  		}

  		echo "</div>";
  		echo "</div>";
	

	
    ?>
</div>
</body>
</html>