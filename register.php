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
				<div class='panel-heading'>註冊頁面</div>
				<div class='panel-body'>
					<form action='register.php' method='POST'>
							<label for='name'>帳號 </label><br>
							<input type='text' name='name' id='name'><br>
							<label for='pass'>密碼 </label><br>
							<input type='password' name='password' id='password'><br>
							<label for='address'>收件地址 </label><br>
							<input type='text' name='address' id='address'><br>

							<label>身分別</label>
							<input type="radio" name="identity" value="user_t" checked>
							<label for="red">買家</label>
							  
							<input type="radio" name="identity" value="sellers">
							<label for="blue">賣家</label> 
							<br>
							  
				
							<input type='submit' value='註冊'>
						</form>
					</form>
				</div>
			</div>
			</div>
		</div>
	</div>
</body>

<?php
	$name=""; 
	$password="";
	$identity = "";
	//取得表單欄位值
	if (isset($_POST["name"])) //isset是檢測該字典是否有對應到這個值
		$name=$_POST['name'];
	if (isset($_POST['password']))
		$password=$_POST['password'];
    if (isset($_POST['address']))
		$address=$_POST['address'];
    if (isset($_POST["identity"])) {
	    $identity = $_POST["identity"];
	}
	

	if ($name!="" && $password!="" && $identity!=""){
		//送出utf8編碼mysql指令,讓某些傳過來的字變成utf8
		mysqli_query($link,'SET NAMES utf8');
		//建立sql指令字串
		$sql ="SELECT * FROM $identity WHERE name='{$name}'";
		$result= mysqli_query($link,$sql);
		$total_records =mysqli_num_rows($result);
		//是否有查詢到使用者紀錄
		if ($total_records>0){
			//登入成功,指定sesssion變數
			echo "<div class='row' align=center>";
			echo "此姓名已被註冊過";
			echo "</div>";
		}
		else{

			$sql="INSERT INTO $identity(name,password,address) VALUES('{$name}','{$password}','{$address}')";
			mysqli_query($link,$sql);
			echo "<div class='row' align=center>";
			if ($identity =='user_t'){
				echo "買家註冊成功";
			}
			else{
				echo "賣家註冊成功";
			}
			echo "</div>";
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