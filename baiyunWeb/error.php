<!-- 出错页面 -->
<html>
	<head>
		<title>错误信息</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link rel="stylesheet" type="text/css" href="style/style.css"/>
	</head>
	<body>
	<div>
			<img src="./image/logo1.gif" width=150 height=110>
	</div>
<!-- 	用户信息、登录、注册 -->
	<div class="h">
	您尚未&nbsp;<a href="login.php">登录</a>
	&nbsp;|&nbsp;<A href="reg.php">注册</A>
	</div>
<!-- 	错误信息 -->
	<div class="t" algin="center">
	<br/>
	<font color="red"><?php echo $_REQUEST["msg"] ?>
	</font>
	<br/>
	<br/>	
</div>
<!-- 尾页 -->
<br/>
	<center class="gray">2021 HongCanJie 版权所有</center>	
	</body>
</html>
