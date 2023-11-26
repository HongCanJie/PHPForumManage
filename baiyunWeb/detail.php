<html>
<head>
<title>查看帖子</title>
<meta http-equiv="description" content="show topic">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="style/style.css"/>
<!-- 导入文件 -->
<?php 
require_once './comm/board.php';
require_once './comm/topic.php';
require_once './comm/reply.php';
?>
<!-- 删除的回帖信息提示 -->
<script type="text/javascript" language="javascript">
function deleteReply(title,replyId,boardId,currentPage){
	if(window.confirm("您确定要删除标题为："+title+"的帖子吗？")){
		var url="./manage/doDeleteReply.php?replyId="+replyId+"&boardId="+boardId+"&currentPage="+currentPage;
// 		点击确定弹窗后执行url路径的代码
		window.location=url;
	}
}
</script>
</head>
<body>
<!-- 头部信息 -->
<?php 
echo do_html_head();
?>
<!-- 主体 -->
<div>
<br/>
<div>
<?php 
// 获取版块编号
$boardId=$_GET["boardId"];
// 获取当前页码
$curPage=$_GET["currentPage"];
// 当前回帖页码
$curReplyPage=$_GET["currentReplyPage"];
// 当前帖子编号
$topicId=$_GET["topicId"];
// 版块名称
$boardName="";
// 当前版块信息
$curBoard=array();
// 当前帖子信息
$curTopic=array();
// 出错信息
$msg="";
// 判断版块编号是否存在
if($boardId!=""){
//     查询指定的版块信息
    $curBoard=findBoard($boardId);
//     查询指定的帖子信息
    $curTopic=findTopicById($topicId);
//     var_dump($curTopic);
//     判断是否查询到版块信息的内容
    if(count($curBoard)>0){
        $boardName=$curBoard["boardName"];
//         var_dump($boardId);
    }else{
        $msg="版块不存在！";
    }
}else{
    $msg="版块编号不存在！";
}
// 判断是否有错误信息
if($msg!=""){
//     跳转到错误页面
    header("location:../error.php?msg=$msg");
}
// echo $topicId;
// 根据帖子编号取出回帖的信息
$replies=findListReply($curReplyPage, $topicId);
// var_dump($replies);
// 统计当前帖子的回帖信息
$replyNum=findCountReply($topicId);
// 页面容量
$pageSize=$GLOBALS["cfg"]["server"]["page_size"];
// 计算总页数
$pages=ceil($replyNum/$pageSize);
$explor=<<<HTML_STR
&gt;&gt;<B><a href="index.php">论坛首页</a></B>&gt;&gt;
<B><a href="list.php?boardId=$boardId&currentPage=1">$boardName</a></B>
HTML_STR;
echo $explor;
?>
</div>
<br/>
<!-- 新帖 -->
<div>
<a href='post.php?<?php echo "boardId=$boardId&topicId=$topicId&currentPage=$curPage"?>'>
<img src="./image/reply.gif" name="td_reply" border="0" id=td_reply width="2%" height="4%"></a>&nbsp;&nbsp;
<a href="post.php?boardId=<?php echo $boardId?>"><img src="./image/post1.gif" name="td_post" border="0" id=td_post width="2%" height="4%"></a>
</div>
<!-- 分页 -->
<div>
<?php 
// 上一页
$page_previous=($curReplyPage<=1)?1:$curReplyPage-1;
// 下一页
$page_next=($curReplyPage>=$pages)?$pages:$curReplyPage+1;
// 没有记录的时候，$page_next的最小值为1
$page_next=($page_next==0)?1:$page_next;
$navigator="<a href='detail.php?boardId=$boardId&currentPage=$curPage&currentReplyPage=$page_previous&topicId=$topicId'>上一页</a>|";
$navigator.="<a href='detail.php?boardId=$boardId&currentPage=$curPage&currentReplyPage=$page_next&topicId=$topicId'>下一页</a>";
$navigator.="|当前是第".$curReplyPage."页/共".$pages."页";
echo $navigator;
?>
</div>
<!-- 页面主题的标题 -->
<div>
<table cellSpacing="0" cellPadding="0" width="100%">
<tr>
	<th class="h">
		本页主题：<?php echo $curTopic['title'];?>
	</th>
</tr>
<tr class="tr2">
	<td>&nbsp;</td>
</tr>
</table>
</div>
<!-- 主题 -->
<?php 
$html_str=<<<HTML_STR
<div class="t">
<table style="border-top-width:0px;table-layout:fixed"
cellSpacing="0" cellPadding="0" width="100%">
<tr class="tr1">
    <th style="width:20%">
    <b>$curTopic[uName]</b><br/>
    <img src="image/head/$curTopic[head]" width=70px heigth=70px/>
    <br/>注册：$curTopic[regTime]<br/>
    </th>
    <th>
        <h4>$curTopic[title]</h4>
        <div>$curTopic[content]</div>
        <div class="tipad gray">
发表：[$curTopic[publishTime]]&nbsp;最后修改：[$curTopic[modifyTime]]
    </div>
   </th>
  </tr>
</table>
</div>
HTML_STR;
//     判断当前帖子是否有回帖  (强制转换为数组格式)
    if(count((array)$replies)>0){
    $flag=false;
    $curId="";
//     判断用户是否登录
    if($_SESSION["CURRENT_USER"]!=""){
//         取当前用户信息
        $current_user=$_SESSION["CURRENT_USER"];
//         var_dump($current_user);
        $curId=$current_user["uId"];
        $flag=true;
    }
//     判断是否为数组形式且判断数组是否为空(可能会没有回帖)
    if(is_array($replies)&&!empty($replies)){
    foreach ($replies as $reply){
//         var_dump($reply);
//         显示一页回帖信息
    $tmp="";
//     判断当前回帖是否是自己发表的，是则可以进行删除和修改
    if($flag && $curId==$reply["uId"]){
        $tmp=<<<HTML_STR
        <a href="javascript:deleteReply('$reply[replyTitle]','$reply[replyId]','$boardId','$curPage')">[删除]</a>
        <a href="update.php?currentPage=$curPage&curReplyPage=$curReplyPage&boardId=$boardId&topicId=$topicId&replyId=$reply[replyId]">[修改]</a>
HTML_STR;
    }
    $html_str.=<<<HTML_STR
    <div class="t">
    <table style="border-top-width:0px; table-layout:fixed" cellSpacing="0" cellPadding="0" width="100%">
    <tr class="tr1">
        <th style="width:20%">
            <b>$reply[uName]</b><br/>
            <img src="image/head/$reply[head]" width=70px heigth=70px/>
            <br/>注册：$reply[regTime]<br/>
        </th>
        <th>
        <h4>$reply[replyTitle]</h4>
        <div>$reply[replyContent]</div>
            <div class="tipad gray">
            发表：[$reply[replyPublishTime]]&nbsp;最后发表：[$reply[replyModifyTime]]
    $tmp
            </div>
           </th>
          </tr>
         </table>
        </div>
HTML_STR;
  
    } 
   }
}
echo $html_str;
?>
</div>
<br/>
<?php  echo do_html_footer()?>
</body>
</html>
