<!-- index.php -->
<!DOCTYPE html>
<html>
    <?php 
        require 'sql_connect.php';
    ?>
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
        <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php
        session_start();
        $url='';
        $url_text='';
        $url_home='';
        if (isset($_SESSION['login_session']) and isset($_SESSION['userid']) and isset($_SESSION['status'])  and $_SESSION['login_session']==true) {
            $url_home="./home.php?id={$_SESSION['userid']}";
            $url='./logout.php';
            $url_text='登出';
        }
        else {
            $url_home='./login.php';        
            $url='./login.php';
            $url_text='登入';
            $url="Location:login.php";
            header($url); //跳轉頁面
            }
    ?>
    	    
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <div class="navbar-brand" align="center">
                            拍賣網站
                    </div>
                </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="./all_product.php">HOME</a></li>
                <li ><a href="./put_on_product.php">上傳商品</a></li>
                <li ><a href="./cart.php">購物車</a></li>
                <li ><a href="<?php echo $url;?>"><?php echo $url_text ;?></a></li>
            </ul>
            </div>
        </nav>
    		
    
</html>
