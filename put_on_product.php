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
</head>
<body>

    <?php
    	include 'after_login_base.php';
    ?>
    

    <div class='row' align=center>
	     <form  method='POST' enctype="multipart/form-data">
	     	上傳商品<br>
	     	<label for='name'>商品名稱</label><br>
	        <input type='text' name='name' id='name'><br> 	
	     	<label for='price'>價格</label><br>
	        <input type='number' name='price' id='price'><br>			        
	        <label for='content'>商品描述</label><br>
	        <textarea name='content' id='content' rows=4 cols=60></textarea><br>
	        
	        
	      
	        <input type="radio" name="choice" value="電子"> 電子
		  	<input type="radio" name="choice" value="家具"> 家具
		  	<input type="radio" name="choice" value="食物"> 食物
			<input type="file" name="image" onchange="showImage(this)">
  			<input type="submit" name="submit_with_info" value="上傳商品">
  			
	        <br>
	        <!-- <input type='submit'><br> -->
	     </form>
	     <img id="image-display" src="">
	</div>
	  	

	  	<script>
	    function showImage(input) {
	      if (input.files && input.files[0]) {
	        var reader = new FileReader();

	        reader.onload = function(e) {
	          document.getElementById('image-display').setAttribute('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	      }
	    }
  		</script>
	<?php


        if ( array_key_exists('content', $_POST) && array_key_exists('price', $_POST) && array_key_exists('name', $_POST) ){
        
        	$name=$_POST['name'];
            $price=$_POST['price'];
            $content=$_POST['content'];
          
            if ($content!=''&&$name!='' && ! empty($_POST['price']) && array_key_exists('choice', $_POST)){
            	$choice = $_POST['choice'];
 
	            if(isset($_FILES['image'])) {
		            if (isset($_SESSION['login_session']) and isset($_SESSION['userid']) and isset($_SESSION['user']) and isset($_SESSION['status']) and $_SESSION['login_session']==true){
		            	$uploadDir = './images/';
						
					

						$files = scandir($uploadDir);
						$fileName = 0;
						foreach ($files as $file) {
						    if ($file != '.' && $file != '..') {
						        $file1 = basename($file);
								$pre_file = intval($file1);
								if ($pre_file>$fileName){
									
									$fileName = $pre_file;
								}
						    }
						}
						
						$fileName = $fileName +1;
						$fileName = strval($fileName).'.jpg';
						$uploadFile = $uploadDir . $fileName;

						if (isset($_SESSION['status']) and $_SESSION['status'] =='seller'){
						  // 將圖片從臨時位置移動到目標位置
								if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
								    // 在此處將文件路徑存儲到MySQL資料庫中
								    $filePath = $uploadFile;
								    $sql="INSERT INTO products(seller_id,name,description,price,image_url,choice)
					                VALUES('{$_SESSION['userid']}','{$name}','{$content}','{$price}','{$filePath}','{$choice}')";
				                    $result=mysqli_query($link,$sql);
				                     //這種插value的要加小括號,url不用
				                    #$url__="Location:./post_index.php?board={$board}";
				                    #header($url__);
				                    echo "<div class='row' align=center>";
				                    echo "圖片上傳成功並存儲到資料庫。";
									echo "</div>";
								   
								  } 

								  else {
								  	echo "<div class='row' align=center>";
				                    echo "圖片上傳失敗。";
									echo "</div>";
								    
								}
		     				}

						else{
							echo "<div class='row' align=center>";
		                    echo "只有賣家可以拍賣東西";
							echo "</div>";
						}
						}
		            else
		                echo "如果要發布文章請先登入";
		         
		    }
		}
        else{
        	echo "<div class='row' align=center>";
            echo "欄位未填寫";
			echo "</div>";
         	
         }
	 }       
      
    ?>
</div>
</body>
</html>