
<!-- 用户登录页面 -->
<html>
	<head>
	<title>管理论坛--登录</title>
	<meta http-equiv=Content-Type content="text/html;charset=utf-8">
	<link rel="stylesheet" type="text/css" href="style/style.css"/>
	<?php
	require_once './comm/comm.php';
	require_once './comm/user.php';
	?>
	<script language="javascript">
	function check(){
		if(document.regForm.uName.value=""){
			alert("用户名不能为空");
			return false;
	}
		if(document.regForm.uPass.value=""){
			alert("密码不能为空");
			return false;
	}
		if(document.loginForm.vCode.value==""){
			alert("验证码不能为空");
			return false;
		}
	}
	</script>	
	</head>
<body>
<!-- 用户信息、登录、注册 -->
<div>
	<?php  echo do_html_head();
// 	判断cookie中是否有uId信息
	if(!empty($_COOKIE["uId"])){
// 	   根据cookie中的uId获取用户信息
	    $user=findUserById($_COOKIE["uId"]);
	    $userName=$user["uName"];
	    $userPass=$user["uPass"];
	}else {
	    $userName="";
	    $userPass="";
	}
	
	
	?>
</div>
<br/>
<!-- 导航 -->
<!-- p 元素会自动在其前后创建一些空白。浏览器会自动添加这些空间，您也可以在样式表中规定。 -->
<div>
	<p>&gt;&gt;<a href="index.php">论坛首页</a></p>
</div>
<!-- 用户登录表单 -->
<div class="t" style="margin-top: 15px" align="center">
	<form name="loginForm" onSubmit="return check()"  action="./manage/doLogin.php" method="post">
	<br/>
	<p>用&nbsp;&nbsp;户&nbsp;&nbsp;名&nbsp;
	<input class="input" tabindex="1" type="text" maxlength="20" size="35" name="uName" value="<?php echo $userName;?>"/>
	</p>
	<p>&nbsp;密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码&nbsp;&nbsp;
	<input class="input" tabindex="2" type="password" maxlength="40" size="36" name="uPass" value="<?php echo $userPass; ?>" />
	</p>
	<p>验&nbsp;&nbsp;&nbsp;证&nbsp;&nbsp;码&nbsp;&nbsp;&nbsp;<input class="input" tabindex="3" type="text" maxlength="20" size="35" name="vCode"/></p>
	&nbsp;&nbsp;<img src="validatecode.php" onclick="this.src='validatecode.php?rand='+Math.random()" alt="点击刷新验证码">
	<p><input class="input" tabindex="4" type="checkbox" name="remember" value="true"/>记住密码，一天内无需登录</p>
	
		<br/>
		<input class="btn" tabindex="6" type="submit" value="登录">
	</form>
</div>
<br/>
<?php  echo do_html_footer()?>
</body>	
</html>