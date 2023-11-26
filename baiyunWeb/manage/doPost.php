<?php 
// 发表新帖子处理
require_once '../comm/topic.php';
// 定义错误信息变量
$msg="";
// 判断当前用户是否登录
if($_SESSION["CURRENT_USER"]){
// 用户已经登录
// 获取当前用户信息
$current_user=$_SESSION["CURRENT_USER"];
// 获取版块编号（隐藏域中）
$boardId=$_POST["boardId"];
// echo $boardId;
// 获取帖子标题
$title=$_POST["title"];
// echo $title;
// 获取帖子内容
$content=$_POST["content"];
// echo $content;
// 发表新帖子
$rs=addTopic($title, $content, $current_user["uId"], $boardId);
// 判断是否发表成功
if($rs==0){
    $msg="发表帖子失败，请重新发表!";
}
}else {
    $msg="用户未登录，请登录后在发布帖子！";
}
// 判断是否有错误信息
if($msg!=""){
//     有错误
    die(header("location:../error.php?msg=$msg"));
}else {
//     发表成功，显示帖子列表
    header("location:../list.php?boardId=$boardId&currentPage=0");
}
?>