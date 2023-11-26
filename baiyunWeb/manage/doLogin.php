<?php
// 导入公共文件
require_once '../comm/user.php';
// 定义字符串变量
$msg="";
if($_POST["uName"]!=""){
//     判断输入验证码是否正确
    if($_POST["vCode"]!=""&&($_POST["vCode"]==$_SESSION["vCode"])){
//     判断用户名是否为空
    $curUser=findUser($_POST["uName"]);
//     print_r($curUser);
//     判断用户的密码是否正确(当cookie值为空时)，如果不进行判断可能会导致已加密的md5的密码值再次进行md5加密，导致判断失败。
    if(empty($_COOKIE["uId"])&&md5($_POST["uPass"])==$curUser["uPass"]){
//         保存用户信息至会话中
        $_SESSION["CURRENT_USER"]=$curUser;
//         判断是否选中记住密码
    if($_POST["remember"]!=""&&$_POST["remember"]==true){
//         设置cookie保存用户编号,其中“/”是指有效路径在根目录，即项目的所有文件均可访问,保存时长1一小时
        setcookie("uId",$curUser["uId"],time()+60*60,"/");
//         echo $_COOKIE["uId"];
    }
//         跳转到首页
        header("location:../index.php");
//         结束运行
        return;
        
    }else 
//     判断用户的密码是否正确(当cookie值不为空时)
        if(!empty($_COOKIE["uId"])&&$_POST["uPass"]==$curUser["uPass"]){
        //         保存用户信息至会话中
        $_SESSION["CURRENT_USER"]=$curUser;
        //         判断是否选中记住密码
        if($_POST["remember"]!=""&&$_POST["remember"]==true){
            //         设置cookie保存用户编号,其中“/”是指有效路径在根目录，即项目的所有文件均可访问
            setcookie("uId",$curUser["uId"],time()+20,"/");
            //         echo $_COOKIE["uId"];
        }
        //         跳转到首页
        header("location:../index.php");
        //         结束运行
        return;
    }else{
        $msg="用户名或口令不正确";
    }  
 }else {
     $msg="验证码不正确";
 }
}else{
    $msg="用户名不能为空";
}
// 返回错误信息
header("location:../error.php?msg=$msg");

?>