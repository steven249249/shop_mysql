<!DOCTYPE html>
<?php
    // 包含共用模板
    include 'base.html';

?>
<body>
	<div class='container-fluid'>
		<div class='row' align=center>
			<div class='col-md-3'></div>
			<div class='col-md-6'>
			<div class='panel panel-default'>
				<div class='panel-heading'>使用者登入頁面</div>
				<div class='panel-body'>
					<form  method='POST'>
						<label for='name'>帳號 </label><br>
						<input type='text' name='name' id='name'><br>
						<label for='pass'>密碼 </label><br>
						<input type='password' name='password' id='password'><br>
						<input type="radio" name="identity" value="user_t" checked>
						<label for="red">買家</label>
						  
						<input type="radio" name="identity" value="sellers">
						<label for="blue">賣家</label> 
						<br>
						<input type='submit' value='登入'>

						
					</form>
				</div>
				</div>
			</div>
		</div>
	</div>
</body>
	
<?php
	session_start();
	$name=""; 
	$password="";
	//取得表單欄位值
	if (isset($_POST["name"]))
		$name=$_POST['name'];
	if (isset($_POST['password']))
		$password=$_POST['password'];

	 if (isset($_POST["identity"])) {
	    $identity = $_POST["identity"];
	}
	

	if ($name!="" && $password!="" && $identity!=""){
		
		//建立sql指令字串
		if ($identity =='user_t'){
			$sql ="SELECT name,buyer_id FROM user_t WHERE password='{$password}' AND name='{$name}'";
			$status = 'user';
		}
		else{
			$sql ="SELECT name,seller_id FROM sellers WHERE password='{$password}' AND name='{$name}'";
			$status = 'seller';

		}
		
	
		$result= mysqli_query($link,$sql);
		$total_records =mysqli_num_rows($result);
		$user=mysqli_fetch_row($result);
		//是否有查詢到使用者紀錄
		if ($total_records>0){
			//登入成功,指定sesssion變數
			$_SESSION['login_session']=true;
			$_SESSION['user']=$user[0];
			$_SESSION['userid']=$user[1];
			$_SESSION['status'] = $status;
			echo "登入成功";
			$url="Location:all_product.php";
			header($url); //跳轉頁面
		}

		else{
			echo "<center><font color='red'>";
			echo "使用者名稱或密碼錯誤!<br/>";
			echo "</font>";
			$_SESSION['login_session']=false;
		}
		mysqli_close($link);
	}
	else{
		echo "<div class='row' align=center>";
		echo "請填滿欄位";
		echo "</div>";
	}
?>
</body>
</html>