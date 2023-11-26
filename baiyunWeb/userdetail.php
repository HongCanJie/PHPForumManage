<!-- 用户信息编辑页面 -->
<html>
	<head>
	<title>管理论坛--用户信息编辑</title>
	<meta http-equiv=Content-Type content="text/html;charset=utf-8">
	<link rel="stylesheet" type="text/css" href="style/style.css"/>
	<script language="javascript">
	function check(){
		if(document.userForm.uName.value=""){
			alert("用户名不能为空");
			return false;
	}
		if(document.userForm.uPass.value!=document.userForm.uPass1.value){
			alert("2次密码不一样");
			return false;
	}
	}
	</script>	
	</head>
<body>
<!-- 用户信息、登录、注册 -->
<?php  
require_once './comm/user.php';
echo do_html_head();
?>
<br/>
<!-- 导航 -->
<!-- p 元素会自动在其前后创建一些空白。浏览器会自动添加这些空间，您也可以在样式表中规定。 -->
<div>
	&gt;&gt;<B><a href="index.php">论坛首页</a></B>
</div>
<!-- 用户信息表单 -->
<div class="t" style="margin-top: 15px" align="center">
<!-- 获取用户数据 -->
<?php 
if(isset($_SESSION["CURRENT_USER"])){
    $current_user=$_SESSION["CURRENT_USER"];
    $uId=$current_user["uId"];
    $user=findUserById($uId);
//     print_r($user);
	$formBuf=<<<HTML_FORM
	<form name="userForm" onSubmit="return check()"  action="./manage/doUserUpdate.php" enctype="multipart/form-data"  method="post">
<!-- hidden属性可以隐藏数据便于传值 -->
	<input name="uId" type="hidden" value="$user[uId]"/>
	<p>用&nbsp;&nbsp;户&nbsp;&nbsp;名&nbsp;
	<input class="input" tabindex="1" type="text" maxlength="20" size="39" name="uname" value="$user[uName]"/>
	</p>
	<p>&nbsp;密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码&nbsp;&nbsp;
	<input class="input" tabindex="2" type="password" maxlength="20" size="40" name="uPass"/>
	</p>
	<p>&nbsp;重复密码&nbsp;&nbsp;
	<input class="input" tabindex="3" type="password" maxlength="20" size="40" name="uPass1" />
	</p>
HTML_FORM;
    if($user["gender"]==2){
        $formBuf.=<<<HTML_FORM
        <br/>性别&nbsp;
    女<input type="radio" name="gender" value="2" checked="checked"/>
    男<input type="radio" name="gender" value="1"/>
<br/>
HTML_FORM;
    }else{
            $formBuf.=<<<HTML_FORM
        <br/>性别&nbsp;
    女<input type="radio" name="gender" value="2" />
    男<input type="radio" name="gender" value="1" checked="checked" />
<br/>
HTML_FORM;
        }
            
        $isSystem=false;
//             头像选中
        for($i=1;$i<=15;$i++){
            if($user["head"]=="$i.gif"){
            $formBuf.="<img src='./image/head/$i.gif' width=70 heigth=70 /><input type='radio' name='head' value='$i.gif' checked='checked'/>";
            
            }else{
            $formBuf.="<img src='./image/head/$i.gif' width=70 heigth=70 /><input type='radio' name='head' value='$i.gif' />";
            }
            if($i%5==0){
                $formBuf.="<br/>";
            }
        }
        
//         自定义头像
        if(!$isSystem){
            $formBuf.="自定义头像&gt;&gt;<img src='./image/head/".$user["head"]."'"."width=70 heigth=70><input type='radio' name='head' value=".$user["head"]."checked='checked'/>";
        }
	   
       $formBuf.=<<<HTML_FORM
          <br/>
          <input type="file" name="myHead">
          <br/>
          <input class="btn" tabindex="4" type="submit" value="修改"/>      
	      </form>
          
HTML_FORM;
       echo $formBuf;
}
?>
</div>
<?php 
echo do_html_footer();
?>
</body>	
</html>
