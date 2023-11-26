
<!-- 用户注册页面 -->
<html>
	<head>
	<title>管理论坛--注册</title>
	<meta http-equiv=Content-Type content="text/html;charset=utf-8">
	<link rel="stylesheet" type="text/css" href="style/style.css"/>
	<?php  require_once './comm/comm.php';?>
	<script language="javascript">
// 	头像初始化
	function init(){
	document.regFrom.head[0].checked=true;
	}
	function check(){
		if(document.regForm.uName.value=""){
			alert("用户名不能为空");
			return false;
	}
		if(document.regForm.uPass.value=""){
			alert("密码不能为空");
			return false;
	}
	if(document.regForm.uPass.value!= document.regForm.uPass1.value){
	alert("2次密码不一样");
	return false;
	}
	</script>	
	</head>
<body onload="init()">
<!-- 用户信息、登录、注册 -->
<div >
	<?php  echo do_html_head();?>
</div>
<br/>
<!-- 导航 -->
<!-- p 元素会自动在其前后创建一些空白。浏览器会自动添加这些空间，您也可以在样式表中规定。 -->
<div>
	<p>&gt;&gt;<a href="index.php">论坛首页</a></p>
</div>
<!-- 用户注册表单 -->
<div class="t" style="margin-top: 15px" align="center">
	<form name="regForm" onSubmit="return check()"  action="./manage/doReg.php" method="post">
	<p>用&nbsp;&nbsp;户&nbsp;&nbsp;名&nbsp;
	<input class="input" tabindex="1" type="text" maxlength="20" size="35" name="uName"/>
	</p>
	<p>&nbsp;密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码&nbsp;&nbsp;
	<input class="input" tabindex="2" type="password" maxlength="20" size="36" name="uPass"/>
	</p>
	<p>&nbsp;重复密码&nbsp;&nbsp;
	<input class="input" tabindex="3" type="password" maxlength="20" size="36" name="uPass1" />
	</p>
	<p>性别&nbsp;
	女<input type="radio" name="gender" value="2">
	男<input type="radio" name="gender" value="1" checked="checked"/>
	</p>
	<p>请选择头像</p>
<?php 
for($i=1;$i<=15;$i++){
    echo"<img src='./image/head/$i.gif' width=70 heigth=70/><input type='radio' name='head' value='$i.gif'/>";
    if($i%5==0){
        echo"<br/>";
    }
}
?>
		<br/>
		<input class="btn" tabindex="4" type="submit" value="注册">
	</form>
</div>
<br/>
<?php  echo do_html_footer()?>
</body>	
</html>