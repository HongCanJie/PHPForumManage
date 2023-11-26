<?php
// 导入文件
require_once '../comm/user.php';
$msg="";
//     判断用户编号和用户名不能为空
if($_POST["uId"]!=""&&$_POST["uname"]!=""){
    if($_FILES["myHead"]["error"]==0){
//         error返回值为0，说明上传成功
    $myHead=$_FILES["myHead"];
//     文件重命名
    $head=$_POST["uId"]."--".$myHead["name"];
//     判断文件格式和文件大小
    if((($myHead["type"]=="image/gif")||($myHead["type"]=="image/jpeg")||($myHead["image/pjpeg"]))&&($myHead["size"]<100000)){
        move_uploaded_file($myHead["tmp_name"], "../image/head/".$head);
    }else {
        $msg="上传文件的后缀名应为gif或jpg，且文件大小应小于100k";
    }
//     更新数据库
    $rs=updateUser($_POST["uId"], $_POST["uname"], md5($_POST["uPass"]),$head, $_POST["gender"]);
    }else {        
//     数据更新,$rs返回受影响的行数
        $rs=updateUser($_POST["uId"], $_POST["uname"],md5($_POST["uPass"]), $_POST["head"], $_POST["gender"]);
    }
    if($rs<=0){
        $msg="用户修改失败";
    }else {
//         跳转页面
        header("location:../userdetail.php");
        return;
    }

  }else {
    $msg="用户名不能为空或用户编号无法获取";
}
// 跳转页面
header("location:../error.php?msg=$msg");
?>