<?php
// 引用配置文件
require_once 'config.php';
// 初始化session
session_start();
// 建立连接数据库的方法
function get_Connent(){
    //     访问数据库
   $connention=mysqli_connect($GLOBALS["cfg"]["server"]["adds"],$GLOBALS["cfg"]["server"]["db_user"],$GLOBALS["cfg"]["server"]["db_psw"],$GLOBALS["cfg"]["server"]["db_name"],$GLOBALS["cfg"]["server"]["db_port"])or die(header("location:./error.php?msg=数据库连接错误"));
//     $connention=mysqli_connect("localhost","root","","baiyun","3306")or die(header("location:./error.php?msg=数据库连接错误"));
    
    //     选择数据库
   mysqli_select_db($connention, "baiyun") or die(header("location:./error.php?msg=数据库名不正确"));
    //     返回连接状态的布尔值
   return $connention;
}



// 执行查询数据库的操作
function execQuery($strQuery){
    //     创建数组
    $result=array();
    //     建立访问数据库
    $connection=get_Connent();
    //     执行数据库指令
    $rs=mysqli_query($connection, $strQuery) or die(header("location:./error.php?msg=查询失败"));
    for($i=0;$i<mysqli_num_rows($rs);$i++){
        //         存入数组
        $result[$i]=mysqli_fetch_assoc($rs);
    }
    //     关闭资源
    mysqli_free_result($rs);
    mysqli_close($connection);
    return $result;
}

// 执行数据更新操作
function execUpdate($strUpdate){
    //     建立数据库连接
    $connection=get_Connent();
    //     执行数据库指令
    $rs=mysqli_query($connection,$strUpdate) or die(header("location:./error.php?msg=数据表更新失败"));
    //     返回受影响的行数
    $result=mysqli_affected_rows($connection);
    //     关闭资源
    mysqli_close($connection);
    return $result;
}

// 页面头部输出
function  do_html_head(){
//     利用定界符连接字符串
//         网页logo
    $headBuf=<<<HEAD
        <div>
            <IMG src="./image/logo1.gif" width=160 height=110>
        </div>
        <DIV class="h">
HEAD;
// 用户信息、登录、注册
// 会话建立，可以获取数据正常登录
    if(isset($_SESSION["CURRENT_USER"])){
        $current_user=$_SESSION["CURRENT_USER"];
        $user_name=$current_user["uName"];
    
    $headBuf.=<<<HTML_HEAD
    您好：&nbsp;<A href="userdetail.php">$user_name</A>&nbsp;|&nbsp;<A href="./manage/doLogout.php">登出</A>&nbsp;|
HTML_HEAD;
}else{
//       显示用户未登录时候  
    $headBuf.=<<<HTML_HEAD
  您尚未&nbsp; <a href="login.php">登录</a>&nbsp;|&nbsp;<A href="reg.php">注册</A>|
HTML_HEAD;
    }
    $headBuf.="</DIV>";
    return $headBuf;
}

//页面尾部
function do_html_footer(){
    return "<center class=\"gray\">2021 HongCanJie 版权所有</center>";
}

?>