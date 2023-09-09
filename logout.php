<!DOCTYPE html>
<?php
    // 包含共用模板
    include 'base.html';

?>
<body>
	<div class="alert alert-warning">登出成功</div>
</body>
<?php
	session_start();
	$_SESSION['login_session']=false;
	$_SESSION['user']=null;
	$_SESSION['userid']=null;
	$_SESSION['status']=null;
	$_SESSION['cart']=null;
?>
</body>
</html>