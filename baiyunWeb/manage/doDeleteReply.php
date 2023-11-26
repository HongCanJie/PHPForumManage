<?php 
// 删除回帖信息
require_once '../comm/reply.php';
// 定义错误信息变量
$msg="";
if($_SESSION["CURRENT_USER"]!=""){
//  获取用户信息
    $current_user=$_SESSION["CURRENT_USER"];
    //var_dump($current_user) ;
// 获取当前页码
    $curPage=empty($_GET["currentPage"])?0:$_GET["currentPage"];
//     获取版块编号
    $boardId=$_GET["boardId"];
    //echo $boardId;
//     获取编辑的回帖编号,判断是否为空
    $replyId=empty($_GET["replyId"])?0:$_GET["replyId"];
//     echo $replyId;
//     获取回贴表信息
    $reply=findReplyById($replyId);
//     var_dump($reply);
//     判断是否有删除帖子的权限
    if ($current_user["uId"]==$reply[0]["uId"]){
        $rs=deleteReply($replyId);
//         rs是布尔值
        if(!$rs){
            $msg="回帖信息删除错误！";
        } 
    }else {
        $msg="当前用户没有删除帖子的权限！";
    }
}else {
    $msg="用户尚未登录，请登录都重试！";
}
if ($msg==""){
    header("location:../list.php?boardId=$boardId&currentPage=$curPage");  
}else {
    die(header("location:../error.php?msg=$msg"));
}

?>