<?php
// 发表回帖修改处理
require_once '../comm/reply.php';
// 定义错误信息变量
$msg="";
// 判断当前用户是否登录
if($_SESSION["CURRENT_USER"]!=""){
    // 用户已经登录
    // 获取当前用户信息
    $current_user=$_SESSION["CURRENT_USER"];
    // 获取版块编号（隐藏域中）
    $boardId=$_POST["boardId"];
//     echo $boardId;
    // 获取帖子标题
    $replyTitle=$_POST["title"];
//     echo $replyTitle;
    // 获取帖子内容
    $replyContent=$_POST["content"];
//     echo $replyContent;
//  获取帖子编号(隐藏域中)
    $topicId=$_POST["topicId"];
//     echo $topicId;
//  获取当前页码
    $curPage=empty($_POST["currentPage"])?0:$_POST["currentPage"];
//     echo $curPage;
//     获取当前回帖的页码（隐藏域中）
    $curReplyPage=empty($_POST["currentReplyPage"]);
//     获取当前回帖编号（隐藏域中）
    $replyId=empty($_POST["replyId"])?0:$_POST["replyId"];
    // 修改回帖
    $rs=updateReply($replyId, $replyTitle, $replyContent);
    // 判断是否发表成功
    if($rs==0){
        $msg="发表回帖失败，请重新发表!";
    }
}else {
    $msg="用户未登录，请登录后在发布回帖！";
}
// 判断是否有错误信息
if($msg!=""){
    //     有错误
    die(header("location:../error.php?msg=$msg"));
}else {
    //     发表成功，显示帖子列表
    header("location:../detail.php?boardId=$boardId&currentPage=$curPage&currentReplyPage=$curReplyPage&topicId=$topicId");
}
?>
