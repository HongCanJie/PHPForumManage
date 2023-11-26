<?php
require_once '../comm/user.php';

$msg="";
if($_POST["uName"]==""){
    $msg="用户名不能为空";
}else if($_POST["uPass"]=="" or strlen($_POST["uPass"])>6){
    $msg="用户密码格式不正确，请输入个数为6的密码";
}else if($_POST["uPass1"]=="" or strlen($_POST["uPass"])>6){
    $msg="重复密码格式不正确，请输入六位数的密码";
}else if($_POST["uPass1"]!=$_POST["uPass"]){
    $msg="重复密码与密码不同";
}else if($_POST["head"]==""){
    $msg="请选择头像";
}else{
//     使用MD5加密
    addUser($_POST["uName"], md5($_POST["uPass"]), $_POST["head"],$_POST["gender"]);
//         成功后，跳转到登录页面
        header("location:../reg.php");
        return ;
    }
// 以上都不成功，跳转到错误信息页面
header("location:../error.php?msg=$msg");
?>